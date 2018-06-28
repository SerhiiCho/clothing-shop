<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\RecivedOrdeEvent' => [
            'App\Listeners\SendSmsListener',
        ],
    ];


    public function boot()
    {
        parent::boot();
    }
}
