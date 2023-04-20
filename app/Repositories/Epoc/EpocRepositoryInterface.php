<?php

namespace App\Repositories\Epoc;

use App\Models\Company;
use App\Models\Empresa;

interface EpocRepositoryInterface
{
   public function getCompany(String $cnpj): ?Company;
   public function getPartnerData(Company $company): ?array;
   public function save(array $dados) : Company;
   public function generateOrder(Company $company, array $order, string $salt, string $transactionCode): ?array;

}
