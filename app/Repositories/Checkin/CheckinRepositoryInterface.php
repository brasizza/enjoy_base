<?php

namespace App\Repositories\Checkin;

use App\Models\Company;

interface CheckinRepositoryInterface
{
    public function checkin(Company $company, array $checkin): ?array;
    public function getTab(Company $company, String $idTab): ?array;

}
