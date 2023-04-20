<?php

namespace App\Http\Actions\Tabs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Tabs\ListTabsUseCase;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class ListTabsAction extends Controller
{
	use ApiResponser;

	public function __invoke(Request $request, ListTabsUseCase $listTabsUseCase): JsonResponse
	{
		$retorno = $listTabsUseCase->handle(company: $this->company );
		return $this->successResponse($retorno);
	}
}
