<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiOrderController extends Controller
{
    /**
     * Open orders
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function opened(): LengthAwarePaginator
    {
        return Order::with('items')
            ->whereNull('user_id')
            ->latest()
            ->paginate(24);
    }

    /**
     * Taken orders
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function taken(): LengthAwarePaginator
    {
        return Order::with(['items', 'user'])
            ->whereNotNull('user_id')
            ->latest()
            ->paginate(24);
    }

    /**
     * Closed orders
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function closed(): LengthAwarePaginator
    {
        return Order::with('items')
            ->onlyTrashed()
            ->latest()
            ->paginate(24);
    }
}
