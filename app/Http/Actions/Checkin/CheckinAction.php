<?php

namespace App\Http\Actions\Checkin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckinRequest;
use App\UseCases\Checkin\CheckinUseCase;
use App\Traits\ApiResponser;
use App\UseCases\Checkin\GetTabUseCase;
use Illuminate\Http\JsonResponse;

class CheckinAction extends Controller
{
    use ApiResponser;

    public function __invoke(CheckinRequest $request, CheckinUseCase $checkinUseCase, GetTabUseCase $getTabUseCase): JsonResponse
    {
        $retorno = $checkinUseCase->handle(company: $this->company, data: $request->all());
        if (isset($retorno['statusCode'])) {
            return $this->errorResponse($retorno['error'], $retorno['statusCode']);
        }
        $tab = $getTabUseCase->handle(company: $this->company, data: $request->all());
        return $this->successResponse($tab ?? []);
    }
}
