<?php

namespace App\UseCases\Tabs;

use App\Models\Company;
use App\Repositories\Tabs\TabsRepositoryInterface;

class ListTabUseCase {


    public function __construct(public TabsRepositoryInterface $tabsRepositoryInterface)
    {

    }


	public function handle(Company $company , int $tab)
	{



		return $this->tabsRepositoryInterface->listTab(company: $company, tab:$tab);
	}
}
