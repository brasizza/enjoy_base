<?php

namespace App\Providers\CustomProvider;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Checkin\CheckinRepositoryInterface;
use App\Repositories\Checkin\CheckinRepository;

class CheckinServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CheckinRepositoryInterface::class, CheckinRepository::class);

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
