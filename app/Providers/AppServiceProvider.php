<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // Bootstrap any application services
    public function boot()
    {
        \Schema::defaultStringLength(191);
        //\Artisan::call('migrate');
        $this->swichLanguage();

        if (app()->env === 'production') {
            \URL::forceScheme('https');
        }
    }

    public function swichLanguage()
    {
        if (Cookie::get('lang')) {
            if (Crypt::decrypt(Cookie::get('lang')) == 'en') {
                app()->setLocale('en');
            }
        }
    }
}
