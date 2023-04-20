<?php

namespace App\Repositories\Tabs;

use App\Exceptions\TabNotFound;
use App\Http\Requests\EnjoyHttpRequest;
use App\Models\Company;

class TabsRepository implements TabsRepositoryInterface
{

    public function listTabs(Company $company): ?array
    {

        $enjoy = $company->hasApi('enjoy');
        $url = env('URL_ENJOY') . '/pos/places/' . $enjoy['id_place_enjoy'] . '/tabs';
        $response = EnjoyHttpRequest::auth()->get($url)->json();

        if(isset($response['statusCode'])){
            throw new TabNotFound($response['error']);
           }
        return $response;
    }


    public function listTab(Company $company, int $tab): ?array
    {

        $enjoy = $company->hasApi('enjoy');
        $url = env('URL_ENJOY') . '/pos/places/' . $enjoy['id_place_enjoy'] . '/tabs/'.$tab??0;
        $response = EnjoyHttpRequest::auth()->get($url)->json();
       if(isset($response['statusCode'])){
        throw new TabNotFound($response['error']);
       }
        return $response;
    }

    public function closeAll(Company $company): ?array
    {

        $tabs = $this->listTabs(company:$company);

       foreach($tabs as $tab){

        $this->closeTab(company:$company, tab: $tab['idTab']);
       }
        return [];
    }

    public function closeTab(Company $company, int $tab): ?array
    {

        $enjoy = $company->hasApi('enjoy');
        $url = env('URL_ENJOY') . '/pos/places/' . $enjoy['id_place_enjoy'] . '/tabs/'.$tab.'/checkout';
        $response = EnjoyHttpRequest::auth()->post($url, [])->json();
        return $response;

    }
}
