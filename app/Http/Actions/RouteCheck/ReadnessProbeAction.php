<?php

namespace App\Http\Actions\RouteCheck;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\UseCases\RouteCheck\ReadNessProbeUseCase;
use Exception;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class ReadnessProbeAction extends Controller
{
    use ApiResponser;

    public function __invoke(Request $request, ReadNessProbeUseCase $readnessProbe)
    {

        try {
            $check = $readnessProbe->handle($request);

            return $this->successResponse($check);
        } catch (Exception $e) {

            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
