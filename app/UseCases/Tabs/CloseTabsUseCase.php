<?php

namespace App\UseCases\Tabs;

use App\Exceptions\TabNotEnabled;
use App\Models\Company;
use App\Repositories\Tabs\TabsRepositoryInterface;

class CloseTabsUseCase {

    public function __construct(public TabsRepositoryInterface $tabsRepositoryInterface)
    {

    }

	public function handle(Company $company , int $tab)
	{

            $tabData = $this->tabsRepositoryInterface->listTab($company,$tab);

            if($tabData['status'] == 'enable'){

               return  $this->tabsRepositoryInterface->closeTab(company:$company,tab:$tab);
            }

            throw new TabNotEnabled("Tab is not enabled to close ");        //
	}
}
