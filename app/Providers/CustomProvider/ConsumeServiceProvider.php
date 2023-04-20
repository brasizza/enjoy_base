<?php

namespace App\Providers\CustomProvider;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Consume\ConsumeRepositoryInterface;
use App\Repositories\Consume\ConsumeRepository;

class ConsumeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConsumeRepositoryInterface::class, ConsumeRepository::class);

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
