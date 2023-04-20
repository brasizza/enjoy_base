<?php

namespace App\Providers\CustomProvider;

use Illuminate\Support\ServiceProvider;

class LoadModulesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(__DIR__ . '/*.php') as $router_provider) {
            $base = basename($router_provider);

            if ($base != 'LoadModulesProvider.php') {
                $fileName = str_replace('.php', '', basename($router_provider));
                $path = __NAMESPACE__ . '\\' . $fileName;
                if (class_exists($path)) {
                    $this->app->register($path);
                }
            }
        }
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
