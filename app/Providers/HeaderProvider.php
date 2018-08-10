<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HeaderProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        if (app()->env === 'production') {
            header("Strict-Transport-Security: max-age=31536000");
        }
    }
}
