<?php

namespace App\UseCases\RouteCheck;
class LiveNessProbeUseCase
{
	public function handle()
    {
        return [microtime()];

    }
}
