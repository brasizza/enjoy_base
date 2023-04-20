<?php

namespace App\Repositories\Balance;

use App\Http\Requests\EpocHttpRequest;
use App\Models\Company;
use App\Traits\EpocBaseTransform;

class BalanceRepository implements BalanceRepositoryInterface
{

    use EpocBaseTransform;
    public function getBalance(Company $company, array $data): ?float
    {
        $url = $company['urlRemoto'];
        $url .= '/API/mod_enjoy/balance/index.php';
        $data = [
            'mac' => $company['mac'],
            'hashemp' => $company['hash_emp'],
            'service' => 'checkBalance',
            'comanda' => $data['idTab'],
            'internal' => true
        ];

        $result =  EpocHttpRequest::send()->post($url, $data);
        $data = $this->toEpocJson(company: $company , data: $result->body());
        return $data ?? 0;
    }
}
