<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class ContactProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services
     *
     * @return void
     * @throws \Exception
     */
    public function boot(): void
    {
        $this->showPhoneNumbersInHeader();
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function showPhoneNumbersInHeader(): void
    {
        try {
            $contacts = cache()->rememberForever('nav_contacts', function () {
                return Contact::with('icon')->get()->toArray();
            });
            view()->share(compact('contacts'));
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
        }
    }
}
