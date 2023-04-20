<?php

namespace App\UseCases\Consume;

use App\Exceptions\SkuNotFound;
use App\Models\Company;
use App\Repositories\Consume\ConsumeRepositoryInterface;
use App\Repositories\Epoc\EpocRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ConsumeUseCase
{


    public function __construct(public ConsumeRepositoryInterface $consumeRepositoryInterface, public EpocRepositoryInterface $epocRepositoryInterface)
    {
    }

    public function handle(Company $company, ?array $data)
    {
        $this->validate($data);
        $order = $this->buildOrder(company: $company, data: $data);

        $salt = md5($data['sku']);
        $this->epocRepositoryInterface->generateOrder(company:$company, order:$order, salt:$salt, transactionCode: $data['transactionReference']);
        return $data;
    }


    private function validate(?array $data)
    {

        if (!isset($data['sku'])) {
            throw new SkuNotFound("SKU not found on " . ($data['cnpj'] ?? 'CNPJ VAZIO') . " - transaction " . ($data['idTransaction'] ?? ''));
        }
    }


    private function buildOrder(Company $company, array $data): ?array
    {
      $order[$data['idTab']] = array();

      $orderRoot = &$order[$data['idTab']];
      $orderRoot['HOST'] = $company['mac'];
      $orderRoot['ITENS'][] = [
        'codigo' => $data['sku'],
        'cod_func' => $company['cod_func'],
        'lancItem' => 'S',
        'tipoItem' => 'P',
        'quantidade' => ($data['mlServed']/1000),
        'enjoy' => true
      ];
        return $order;
    }
}
