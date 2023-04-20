<?php

namespace App\UseCases\Tabs;

use App\Models\Company;
use App\Repositories\Tabs\TabsRepositoryInterface;

class ListTabsUseCase {

    public function __construct(public TabsRepositoryInterface $tabsRepositoryInterface)
    {

    }

	public function handle(Company $company)
	{
       return $this->tabsRepositoryInterface->listTabs(company:$company);
	}
}
