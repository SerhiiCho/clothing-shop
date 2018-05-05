<?php

namespace App\Providers;

use App\Models\Card;
use Illuminate\Support\ServiceProvider;

class EloquentEventProvider extends ServiceProvider
{
    // Bootstrap services
    public function boot()
    {
        Card::observe(\App\Observers\CardObserver::class);
    }
}
