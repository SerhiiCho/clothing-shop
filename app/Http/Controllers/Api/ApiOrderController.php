<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class ApiOrderController extends Controller
{
    /**
     * Open orders
     */
    public function opened()
    {
        return OrderResource::collection(
            Order::with('items')
                ->whereNull('user_id')
                ->latest()
                ->paginate(24)
        );
    }

    /**
     * Taken orders
     */
    public function taken()
    {
        return OrderResource::collection(
            Order::with('items', 'user')
                ->whereNotNull('user_id')
                ->latest()
                ->paginate(24)
        );
    }

    /**
     * Closed orders
     */
    public function closed()
    {
        return OrderResource::collection(
            Order::with('items')
                ->onlyTrashed()
                ->latest()
                ->paginate(24)
        );
    }

    /**
     * Count all orders
     *
     * @return array
     * @throws \Exception
     */
    public function count(): array
    {
        return cache()->rememberForever('counted_orders', function () {
            return [
                Order::whereNull('user_id')->count(),
                Order::whereNotNull('user_id')->count(),
                Order::onlyTrashed()->count(),
            ];
        });
    }
}
