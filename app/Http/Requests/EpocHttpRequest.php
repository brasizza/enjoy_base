<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class EpocHttpRequest
{
    public static function send(): PendingRequest
    {
        return Http::asForm()->retry(3, 500, function (Exception $exception, PendingRequest $request) {
            return $exception instanceof ConnectionException;
        });
    }
}
