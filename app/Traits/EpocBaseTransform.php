<?php


namespace App\Traits;

use App\Exceptions\EpocResponseException;
use App\Models\Company;
use Exception;

/**
 *
 */
trait EpocBaseTransform
{

    public function toEpocJson( Company $company , ?string $data){

        if(empty($data)){
            throw new EpocResponseException("Corrupted Data! from {$company['cnpj']}", 0);

        }
        $unbased = base64_decode($data);

        $json = json_decode($unbased,true);

        if($json['status'] != 1 ){

            throw new EpocResponseException("Error from {$company['cnpj']} {$json['msg']}", 0);
        }
        return $json['data'];
    }

}
