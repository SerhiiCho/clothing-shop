<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @param string|null $tab
     * @return \Illuminate\View\View
     */
    public function index(?string $tab = null): View
    {
        if ($tab && $tab === 'closed') {
            $orders = Order::onlyTrashed()->latest()->paginate(24);
        } else {
            $orders = Order::latest()->paginate(24);
        }

        return view('admin.orders.index', compact('orders', 'tab'));
    }

    /**
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function softDelete(Order $order): RedirectResponse
    {
        $order->delete();
        cache()->forget('orders');

        return redirect('/admin/orders')->withSuccess(
            trans('messages.order_closed')
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $order = Order::onlyTrashed()->whereId($id)->first();

        $item_ids = array_map(function ($item) {
            return $item['id'];
        }, $order->items->toArray());

        $order->items()->detach($item_ids);
        $order->forceDelete();

        return redirect('/admin/orders/closed')->withSuccess(
            trans('messages.order_deleted')
        );
    }
}
