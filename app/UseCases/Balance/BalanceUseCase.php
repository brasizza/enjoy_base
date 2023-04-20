<?php

namespace App\UseCases\Balance;

use App\Models\Company;
use App\Repositories\Balance\BalanceRepositoryInterface;
use App\Repositories\Epoc\EpocRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BalanceUseCase {


    public function __construct(public BalanceRepositoryInterface $balanceRepositoryInterface  , public EpocRepositoryInterface $epocRepositoryInterface){}


	public function handle(Company $company,  array $data):?float
	{


        $balance = $this->balanceRepositoryInterface->getBalance(company: $company , data: $data  );
        return $balance ?? 0 ;

	}
}
