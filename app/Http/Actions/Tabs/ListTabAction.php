<?php

namespace App\Http\Actions\Tabs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Tabs\ListTabUseCase;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class ListTabAction extends Controller
{
	use ApiResponser;

	public function __invoke($tab ,  Request $request, ListTabUseCase $listTabUseCase): JsonResponse
	{


		$retorno = $listTabUseCase->handle(company: $this->company, tab : $tab );

		return $this->successResponse($retorno);
	}
}
