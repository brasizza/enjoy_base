<?php

namespace App\Http\Actions\OpenTap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\OpenTap\OpenTapUseCase;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class OpenTapAction extends Controller
{
	use ApiResponser;

	public function __invoke(Request $request, OpenTapUseCase $openTapUseCase): JsonResponse
	{
		$retorno = $openTapUseCase->handle($request->all());
		return $this->successResponse($retorno);
	}
}
