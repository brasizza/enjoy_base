<?php

namespace App\Http\Actions\Tabs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Tabs\CloseAllUseCase;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class CloseAllAction extends Controller
{
	use ApiResponser;

	public function __invoke(Request $request, CloseAllUseCase $closeAllUseCase): JsonResponse
	{
		$retorno = $closeAllUseCase->handle(company:$this->company);
		return $this->successResponse($retorno);
	}
}
