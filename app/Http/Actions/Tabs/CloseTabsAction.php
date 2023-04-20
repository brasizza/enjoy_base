<?php

namespace App\Http\Actions\Tabs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Tabs\CloseTabsUseCase;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class CloseTabsAction extends Controller
{
	use ApiResponser;

	public function __invoke($tab , Request $request, CloseTabsUseCase $closeTabsUseCase): JsonResponse
	{

		$retorno = $closeTabsUseCase->handle(company: $this->company, tab: $tab);
		return $this->successResponse($retorno);
	}
}
