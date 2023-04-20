<?php

namespace App\UseCases\Checkin;

use App\Models\Company;
use App\Repositories\Checkin\CheckinRepositoryInterface;

class GetTabUseCase {

    public function  __construct(public CheckinRepositoryInterface $checkinRepositoryInterface){}

	public function handle(Company $company, array $data)
	{
        return $this->checkinRepositoryInterface->getTab(company:$company, idTab: $data['comanda']);

	}
}
