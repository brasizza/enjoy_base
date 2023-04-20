<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        "cnpj",
        "cod_instalacao",
        "hash_emp",
        "fantasia_emp",
        "urlsistema",
        'urlRemoto',
        'apis',
        'enjoy',
        'mac',
        'cod_usu',
        'cod_func',
        'refresh_at'

    ];


    public function getApisAttribute($dado)
    {
        return (json_decode($dado, true));
    }


    public function setApisAttribute($dado)
    {
        $this->attributes['apis'] = json_encode($dado);
    }


    public function getCnpjAttribute($dado)
    {

        return str_pad($dado, 14, 0, STR_PAD_LEFT);
    }

    public function hasApi($key): ?array{

        $api =json_decode( $this->attributes['apis'],true);

        if(isset($api[$key])){
            return $api[$key];
        }
        return null;

    }
}
