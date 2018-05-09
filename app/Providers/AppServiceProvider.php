<?php

namespace App\Providers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
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

		/**
		 * This header I added because I've been gettin error
		 * with Vue.js when I was clicking button to go on another page
		 * using pagination, so I found this solution.
		 */
		//header('Access-Control-Allow-Origin: *');
    }

    // Register any application services
    public function register()
    {
        //
    }
}
