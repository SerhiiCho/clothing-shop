<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\ServiceProvider;

class GsmProvider extends ServiceProvider
{
    public function boot()
    {
        $this->showPhoneNumbersInHeader();
    }

    public function showPhoneNumbersInHeader()
    {
        view()->composer('includes.gsm', function ($view) {
            $view->withContacts(Contact::all());
        });
    }
}
