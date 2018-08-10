<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeProvider extends ServiceProvider
{
    public function boot()
    {
        $this->callMyCustomDirectives();
    }

    public function callMyCustomDirectives()
    {
        Blade::if('admin', function () {
            return auth()->check() && user()->isAdmin();
        });

        Blade::if('master', function () {
            return auth()->check() && user()->isMaster();
        });

        Blade::if('member', function () {
            return auth()->check() && user()->isMember();
        });

        Blade::if('blogger', function () {
            return auth()->check() && user()->isBlogger();
        });
    }
}
