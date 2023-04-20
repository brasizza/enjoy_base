<?php

namespace App\Http\Actions\Balance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Balance\CheckBalanceUseCase;
use App\Traits\ApiResponser;
use App\UseCases\Balance\BalanceUseCase;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class CheckBalanceAction extends Controller
{
	use ApiResponser;

	public function __invoke(Request $request, BalanceUseCase $checkBalanceUseCase): JsonResponse
	{

        $data = $request->all();
		$retorno = $checkBalanceUseCase->handle(company: $this->company, data: $data);
		   return response()->json(['balance' => $retorno]);
	}
}
