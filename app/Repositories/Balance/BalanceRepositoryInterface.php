<?php

namespace App\Repositories\Balance;

use App\Models\Company;

interface BalanceRepositoryInterface
{


    public function getBalance(Company $company, array $data) :?float;

}
