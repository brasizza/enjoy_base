<?php

namespace App\UseCases\Checkin;

use App\Helpers\CustomHelpers;
use App\Models\Company;
use App\Repositories\Checkin\CheckinRepositoryInterface;

class CheckinUseCase {

    public function  __construct(public CheckinRepositoryInterface $checkinRepositoryInterface){}

	public function handle(Company $company, array $data)
	{
        $checkinData = [
            'plan' => 'prepaid',
            'consumer' => $data,
            'consumerReference' => $data['comanda'],
            'consumptionIpn' => CustomHelpers::consumeWebHook($company),
            'openTapIpn' => CustomHelpers::oepnTapWebHook(),
            'balanceIpn' => CustomHelpers::balanceWebHook(),

        ];


        return $this->checkinRepositoryInterface->checkin(company:$company,checkin: $checkinData);


	}
}
