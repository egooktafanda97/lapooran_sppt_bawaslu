<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Package\Model\ServiceProviders as PackageServiceProviders;

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
        new PackageServiceProviders();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
