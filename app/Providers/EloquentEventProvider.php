<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\Slider;
use Illuminate\Support\ServiceProvider;

class EloquentEventProvider extends ServiceProvider
{
    /**
     * Bootstrap services
     *
     * @return void
     */
    public function boot(): void
    {
        $this->callModelObservers();
    }

    /**
     * @return void
     */
    private function callModelObservers(): void
    {
        Card::observe(\App\Observers\CardObserver::class);
        Slider::observe(\App\Observers\SliderObserver::class);
    }
}
