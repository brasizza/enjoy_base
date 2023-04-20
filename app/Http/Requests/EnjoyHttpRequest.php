<?php

namespace App\Http\Requests;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class EnjoyHttpRequest
{
   public static function auth(): PendingRequest{
   return Http::withHeaders([
        'x-api-key' => env('KEY_ENJOY')
   ]);
   }
}
