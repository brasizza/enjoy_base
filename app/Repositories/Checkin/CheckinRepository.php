<?php

namespace App\Repositories\Checkin;

use App\Http\Requests\EnjoyHttpRequest;
use App\Models\Company;
class CheckinRepository implements CheckinRepositoryInterface
{

    public function checkin(Company $company, array $checkin): ?array
    {
        $enjoy = $company->hasApi('enjoy');
        $url = env('URL_ENJOY').'/pos/places/'.$enjoy['id_place_enjoy'].'/tabs/'.$checkin['consumer']['comanda'].'/checkin';
       $response = EnjoyHttpRequest::auth()->post($url,$checkin)->json();
       return $response;

    }


    public function getTab(Company $company, string $idTab): ?array
    {
        $enjoy = $company->hasApi('enjoy');
        $url = env('URL_ENJOY').'/pos/places/'.$enjoy['id_place_enjoy'].'/tabs/'.$idTab;
        $response = EnjoyHttpRequest::auth()->get($url)->json();
        return $response;
    }
}
