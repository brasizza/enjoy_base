<?php

namespace App\Http\Actions\Consume;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Consume\ConsumeUseCase;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class ConsumeAction extends Controller
{
	use ApiResponser;

	public function __invoke(Request $request, ConsumeUseCase $consumeUseCase): JsonResponse
	{
		$retorno = $consumeUseCase->handle(company: $this->company, data: $request->all());
		return $this->successResponse($retorno);
	}
}
