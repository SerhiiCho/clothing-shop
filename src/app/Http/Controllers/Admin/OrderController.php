<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function softDelete(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect('/admin/work')->withSuccess(
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

        return redirect('/admin/work/closed')->withSuccess(
            trans('messages.order_deleted')
        );
    }
}
