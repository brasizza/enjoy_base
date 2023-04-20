<?php

namespace App\Helpers;

use App\Models\Company;

class CustomHelpers
{


    private static function _baseurl(): string
    {
        $currenturl = '';
        if (env('APP_DEBUG')) {
            return env('WEBHOOK_DEBUG_ENJOY');
        } else {
            $currenturl = basename(url()->previous()) . '/' . Request()->route()->getPrefix();
        }

        return $currenturl;
    }

    public static function oepnTapWebHook(): string
    {
        return self::_baseurl() . '/open';
    }


    public static function balanceWebHook(): string
    {
        return self::_baseurl() . '/balance';
    }

    public static function consumeWebHook(Company $company): string
    {
        return self::_baseurl() . "/consume?cnpj={$company['cnpj']}";
    }
}
