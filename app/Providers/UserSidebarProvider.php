<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;

class UserSidebarProvider extends ServiceProvider
{
    public function boot()
    {
        $this->showAllOrderMessages();
    }

    /**
     * Count all messages and if there are more than
     * 1 message, display them on user-sidebar
     */
    public function showAllOrderMessages()
    {
        $messages = Message::all()->count();
        $has_messages = 'data-notif=' . $messages . '';
        $unreaded = ($messages !== 0) ? $has_messages : '';

        view()->composer('includes.user-sidebar', function ($view) use ($unreaded) {
            $view->with(compact('unreaded'));
        });
    }
}
