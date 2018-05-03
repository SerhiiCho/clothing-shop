<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;

class UserSidebarProvider extends ServiceProvider
{
    /**
     * Count all messages and if there are more than
	 * 1 message, display them on user-sidebar
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
}
