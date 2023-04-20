<?php

namespace App\UseCases\RouteCheck;

use App\UseCases\UseCaseInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ReadNessProbeUseCase
{
	public function handle(Request $request): array
	{
            Schema::connection('sqlite')->getConnection()->reconnect();

        return [microtime()];
	}
}
