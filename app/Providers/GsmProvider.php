<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\ServiceProvider;

class GsmProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->showPhoneNumbersInHeader();
    }

    /**
     * @return void
     */
    public function showPhoneNumbersInHeader()
    {
        $contacts = cache()->rememberForever('nav_contacts', function () {
            return Contact::with('icon')->get()->toArray();
        });

        view()->composer('includes.gsm', function ($view) use ($contacts) {
            $view->withContacts($contacts);
        });
    }
}
