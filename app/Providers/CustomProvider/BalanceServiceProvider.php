<?php

namespace App\Providers\CustomProvider;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Balance\BalanceRepositoryInterface;
use App\Repositories\Balance\BalanceRepository;

class BalanceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BalanceRepositoryInterface::class, BalanceRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
