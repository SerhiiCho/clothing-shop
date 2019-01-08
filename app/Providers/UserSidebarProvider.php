<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class UserSidebarProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->countAllOrderMessages();
        $this->countAllNonAdminUsers();
    }

    /**
     * Count all orders and if there are more than
     * 1 order, display them on user-sidebar
     *
     * @return void
     */
    public function countAllOrderMessages(): void
    {
        try {
            view()->composer('includes.user-sidebar', function ($view) {
                $view->with([
                    'orders' => cache()->rememberForever('orders', function () {
                        return Order::whereUserId(null)->count();
                    }),
                ]);
            });
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function countAllNonAdminUsers(): void
    {
        try {
            view()->composer('includes.user-sidebar', function ($view) {
                $view->with([
                    'non_admin_users' => cache()->rememberForever('non_admin_users', function () {
                        return User::whereAdmin(0)->count();
                    }),
                ]);
            });
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
        }
    }
}
