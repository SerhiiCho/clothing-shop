<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        Blade::if('admin', function () {
            return auth()->check() && user()->isAdmin();
        });

        Blade::if('master', function () {
            return auth()->check() && user()->isMaster();
        });
    }
}
