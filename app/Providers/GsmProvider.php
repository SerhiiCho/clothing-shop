<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class GsmProvider extends ServiceProvider
{
    // Bootstrap services
    public function boot()
    {
        if (Schema::hasTable('contacts')) {
			view()->composer('includes.gsm', function ($view) {
				$view->withContacts(Contact::all());
			});
		}
    }
}
