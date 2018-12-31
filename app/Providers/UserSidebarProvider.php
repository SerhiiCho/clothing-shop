<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class UserSidebarProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->showAllOrderMessages();
    }

    /**
     * Count all orders and if there are more than
     * 1 order, display them on user-sidebar
     *
     * @return void
     */
    public function showAllOrderMessages(): void
    {
        try {
            $orders = cache()->rememberForever('orders', function () {
                return Order::count();
            });
            $has_orders = "data-notif={$orders}";
            $unreaded = ($orders != 0) ? $has_orders : '';

            view()->composer('includes.user-sidebar', function ($view) use ($unreaded) {
                $view->with(compact('unreaded'));
            });
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
        }
    }
}
