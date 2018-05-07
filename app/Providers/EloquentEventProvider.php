<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\Slider;
use Illuminate\Support\ServiceProvider;

class EloquentEventProvider extends ServiceProvider
{
    // Bootstrap services
    public function boot()
    {
        Card::observe(\App\Observers\CardObserver::class);
        Slider::observe(\App\Observers\SliderObserver::class);
    }
}
