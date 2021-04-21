<?php

namespace App\Providers;

use App\Listeners\SendSmsListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        \App\Events\RecivedOrderEvent::class => [
            \App\Listeners\SendSmsListener::class,
        ],
    ];

    /**
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }
}
