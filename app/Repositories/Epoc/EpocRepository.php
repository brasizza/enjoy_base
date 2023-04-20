<?php

namespace App\Repositories\Epoc;

use App\Exceptions\DeviceNotFound;
use App\Http\Requests\EpocHttpRequest;
use App\Models\Company;
use App\Traits\EpocBaseTransform;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class EpocRepository implements EpocRepositoryInterface
{

    use EpocBaseTransform;
    public function getCompany(string $cnpj): ?Company
    {

        $url = env('URL_API_EPOC') . '/checkEmpresa';
        $dados  = ['cnpj' => $cnpj];
        $response =  Http::post($url, $dados);
        if ($response->successful()) {
            $dados = $response->json();
            $company = new Company($dados);
            $dados = $this->getPartnerData($company);
            $company->fill($dados);
           return  $this->save($company->toArray());
        }

        return null;
    }

    public function getPartnerData(Company $company): ?array
    {
        try {
            $url = $company['urlRemoto'] . 'API/interna/habilitar_enjoy.php';
            $result  =  EpocHttpRequest::send()->timeout(10)->connectTimeout(3)->post($url, ['cnpj' => $company['cnpj'], 'nome_host' => 'ENJOY']);
            if($result->successful()){
            $jsonData = $this->toEpocJson(company: $company ,data: $result->body());
            return $jsonData;
            }else{
                throw new DeviceNotFound("Fail to get partner device {$company['cnpj']}", 0);

            }
        } catch (ConnectionException) {
            throw new DeviceNotFound("Fail to get partner device {$company['cnpj']}", 0);
        } catch (Exception $e) {
            throw  $e;

        }
    }

    public function save(array $dados): Company
    {
        if (isset($dados['apis'])) {
            if (isset($dados['apis']['enjoy'])) {
                $dados['enjoy'] = ($dados['apis']['enjoy']['id_place_enjoy']);
            }
        }
        $dados['refresh_at'] = date('Y-m-d H:i:s', strtotime('+12 hours'));
        return Company::create($dados);
    }


    public function generateOrder(Company $company, array $order, string $salt, string $transactionCode): ?array
    {


        $dataVenda = base64_encode(json_encode($order));


        $dadosOrder = [

            'tokenTransacao' => $transactionCode,
            'dataVenda' => $dataVenda,
            'mac' => $company['mac'],
            'service' => 'GravarVendaItem',
            'internal'=>true,
            'hashemp' => $company['hash_emp'],
            'salt' => $salt
        ];



        $url = $company['urlRemoto'] . 'API/mod_venda_item/index.php';
        $result  =  EpocHttpRequest::send()->timeout(10)->connectTimeout(3)->post($url, $dadosOrder);
        $jsonData = $this->toEpocJson(company: $company ,data: $result->body());
        // dataVenda:eyIyMTUiOnsiSE9TVCI6IjY0Ojc3OjkxOmNmOjM2OmUyIiwiSVRFTlMiOlt7ImNvZGlnbyI6MjE0 MSwib2JzIjp7ImNvZF9tb2RpZmljYWRvciI6MCwiZGVzY19vYnMiOiJzXC9hemVpdG9uYSIsImNv ZF9vYnMiOjI1fSwiZGVzY29udG8iOjAsImxhbmNJdGVtIjoiUyIsImNvZF9mdW5jX2F1dG9yaXoi OjAsInRpcG9JdGVtIjoiUCIsInF1YW50aWRhZGUiOjEsIm1vdGl2b19hdXRvcml6YWNhbyI6IjEi LCJhY3Jlc2NpbW8iOjAsIm1hcmNoYXIiOjAsImNvZF9mdW5jIjoiNSJ9LHsiY29kaWdvIjoyMTQx LCJvYnMiOnsiY29kX21vZGlmaWNhZG9yIjowLCJkZXNjX29icyI6InNcL2F6ZWl0b25hIiwiY29k X29icyI6MjV9LCJkZXNjb250byI6MCwibGFuY0l0ZW0iOiJTIiwiY29kX2Z1bmNfYXV0b3JpeiI6 MCwidGlwb0l0ZW0iOiJQIiwicXVhbnRpZGFkZSI6MSwibW90aXZvX2F1dG9yaXphY2FvIjoiMSIs ImFjcmVzY2ltbyI6MCwibWFyY2hhciI6MCwiY29kX2Z1bmMiOiI1In1dfX0
            // mac:64:77:91:cf:36:e2
            // service:GravarVendaItem
            // token:jkn9068d45k7ad01
            // hashemp:jkn9068d45k7ad01
            // salt:6591a099ab39fca994cdceda44143d9e

        return null;
    }
}

