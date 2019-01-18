<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class ApiOrderController extends Controller
{
    /**
     * Open orders
     *
     * @return object
     */
    public function opened(): object
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
     *
     * @return object
     */
    public function taken(): object
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
     *
     * @return object
     */
    public function closed(): object
    {
        return OrderResource::collection(
            Order::with('items')
                ->onlyTrashed()
                ->latest()
                ->paginate(24)
        );
    }
}
