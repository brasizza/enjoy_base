<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiNotFound;
use App\Exceptions\CompanyNotFound;
use App\Models\Company;
use App\Repositories\Epoc\EpocRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected ?Company $company;
    public function __construct(Request $request, public EpocRepositoryInterface $epocRepositoryInterface)
    {

        if ($request->has('cnpj')) {

            $this->company = Company::where('cnpj', $request->cnpj)->first() ?? null;
            if ($this->company == null) {
                $this->company = $epocRepositoryInterface->getCompany($request->cnpj);
            }else{
                $now = strtotime(date('Y-m-d H:i:s'));

                $refresh_at = strtotime($this->company['refresh_at']);
                if($now > $refresh_at){
                    Log::debug("REFRESH TOKENS");
                    $this->company->delete();
                    $this->company = $epocRepositoryInterface->getCompany($request->cnpj);

                }elsE{
                    Log::debug("NO NEED REFRESH TOKENS ONLY {$this->company['refresh_at']}");

                }
            }

            if ($this->company == null) {
                throw new CompanyNotFound("Company $request->cnpj not found");
            }
            if (empty($this->company->hasApi('enjoy'))) {
                throw new ApiNotFound("Enjoy not found", 0);
            }
        } else {
            if($request->has('idPlace')){

                $this->company = Company::where('enjoy', $request->idPlace)->first() ?? null;
            }else{

            throw new CompanyNotFound("Company {$request->idPlace} not found");
            }
        }
    }
}
