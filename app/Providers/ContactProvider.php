<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Support\ServiceProvider;

class ContactProvider extends ServiceProvider
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
        $gsm = cache()->rememberForever('nav_gsm', function () {
            return Contact::with('icon')->get()->toArray();
        });

        view()->composer('includes.gsm', function ($view) use ($gsm) {
            $view->withGsm($gsm);
        });
    }
}
