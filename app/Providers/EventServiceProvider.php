<?php

namespace App\Providers;

use App\Listeners\SendSmsListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\RecivedOrderEvent::class => [
            \App\Listeners\SendSmsListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
