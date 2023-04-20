<?php

namespace App\UseCases\Tabs;

use App\Models\Company;
use App\Repositories\Tabs\TabsRepositoryInterface;

class CloseAllUseCase {

    public function __construct(public TabsRepositoryInterface $tabsRepositoryInterface)
    {

    }

	public function handle(Company $company)
	{
		return $this->tabsRepositoryInterface->closeAll(company:$company);
	}
}
