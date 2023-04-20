<?php

namespace App\Http\Actions\RouteCheck;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\UseCases\RouteCheck\GlobalCheckUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class GlobalCheckAction extends Controller
{
	use ApiResponser;


	public function __invoke(Request $request, GlobalCheckUseCase $globalCheckUseCase)
	{

        try{
            $check = $globalCheckUseCase->handle($request);

		return $this->successResponse($check);
        }catch(Exception $e){



            return $this->errorResponse($e->getMessage(), 500);
        }
	}
}
