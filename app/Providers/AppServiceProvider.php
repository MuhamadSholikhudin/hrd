<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // Paginator::defaultView('view-name');
 
        // Paginator::defaultSimpleView('view-name');

        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
