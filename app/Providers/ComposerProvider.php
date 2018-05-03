<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;

class ComposerProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		$messages = Message::all()->count();
		$has_messages = 'data-notif=' . $messages . '';
		$unreaded = ($messages !== 0) ? $has_messages : '';

		view()->composer('includes.user-sidebar', function ($view) use ($unreaded) {
			$view->with(compact('unreaded'));
		});
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
