<?php

namespace App\Providers\CustomProvider;

use Illuminate\Support\ServiceProvider;

use App\Repositories\OpenTap\OpenTapRepositoryInterface;
use App\Repositories\OpenTap\OpenTapRepository;

class OpenTapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OpenTapRepositoryInterface::class, OpenTapRepository::class);

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
