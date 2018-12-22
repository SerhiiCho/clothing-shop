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
        $contacts = cache()->rememberForever('nav_contacts', function () {
            return Contact::with('icon')->get()->toArray();
        });

        view()->share(compact('contacts'));
    }
}
