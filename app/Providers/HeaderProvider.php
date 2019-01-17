<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HeaderProvider extends ServiceProvider
{
    /**
     * Add headers
     *
     * @return void
     */
    public function boot(): void
    {
        if (app()->env === 'production') {
            header("Strict-Transport-Security: max-age=31536000");
        }
    }
}
