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

            view()->composer('includes.user-sidebar', function ($view) use ($orders) {
                $view->with(compact('orders'));
            });
        } catch (QueryException $e) {
            logs()->error($e->getMessage());
        }
    }
}
