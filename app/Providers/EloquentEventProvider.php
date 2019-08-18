<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\Slider;
use App\Observers\CardObserver;
use App\Observers\SliderObserver;
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
        Card::observe(CardObserver::class);
        Slider::observe(SliderObserver::class);
    }
}
