<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuProdiver extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            // dd(\App\Repositories\ImageRepository::getRoutes());
            $view->with('menu', \App\Repositories\ImageRepository::getRoutes());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
