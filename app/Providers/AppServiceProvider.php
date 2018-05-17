<?php

namespace App\Providers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Resources\Json\Resource;

class AppServiceProvider extends ServiceProvider
{
    // Bootstrap any application services
    public function boot()
    {
		// For Database
		Schema::defaultStringLength(191);

		// Change language
		if (Cookie::get('lang')) {
			if (Crypt::decrypt(Cookie::get('lang')) == 'en') {
				app()->setLocale('en');
			}
		}

		// Header for javascript
		//header('Access-Control-Allow-Origin: *');
    }

    // Register any application services
    public function register()
    {
        //
    }
}
