<?php

namespace App\Providers\CustomProvider;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Epoc\EpocRepositoryInterface;
use App\Repositories\Epoc\EpocRepository;

class EpocServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EpocRepositoryInterface::class, EpocRepository::class);

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
