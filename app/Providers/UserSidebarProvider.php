<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Database\QueryException;
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
     *
     * @return void
     */
    public function showAllOrderMessages()
    {
        if (auth()->check()) {
            try {
                $messages = Message::all()->count();
                $has_messages = 'data-notif=' . $messages . '';
                $unreaded = ($messages !== 0) ? $has_messages : '';

                view()->composer('includes.user-sidebar', function ($view) use ($unreaded) {
                    $view->with(compact('unreaded'));
                });
            } catch (QueryException $e) {
                logs()->error($e->getMessage());
            }
        }
    }
}
