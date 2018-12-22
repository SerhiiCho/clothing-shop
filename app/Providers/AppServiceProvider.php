<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // Bootstrap any application services
    public function boot()
    {
        \Schema::defaultStringLength(191);
        //\Artisan::call('migrate');

        // if (app()->env === 'production') {
        //     \URL::forceScheme('https');
        // }
    }
}
