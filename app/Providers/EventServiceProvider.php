<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\RecivedOrdeEvent::class => [
            \App\Listeners\SendSmsListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
