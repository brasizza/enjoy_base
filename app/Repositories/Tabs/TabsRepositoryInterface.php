<?php

namespace App\Repositories\Tabs;

use App\Models\Company;

interface TabsRepositoryInterface
{

    public function listTabs(Company $company):?array;
    public function listTab(Company $company, int $tab): ?array;
    public function closeTab(Company $company, int $tab): ?array;
    public function closeAll(Company $company): ?array;

}
