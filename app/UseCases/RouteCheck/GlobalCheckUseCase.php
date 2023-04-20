<?php

namespace App\UseCases\RouteCheck;

use App\Repositories\Epoc\EpocRepositoryInterface;
use App\UseCases\Empresa\CheckEmpresaUseCaseInterface;
use App\UseCases\UseCaseInterface;
use Exception;
use Illuminate\Http\Request;

class GlobalCheckUseCase
{

    public function __construct(public EpocRepositoryInterface $epocRepositoryInterface){}


	public function handle(Request $request ): array
	{
        // $this->checkEmpresaUseCaseInterface->handle(new Request(['cnpj' => '087232180008196']));
		return [microtime()];

	}
}
