<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
     * Take order
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Order $order): RedirectResponse
    {
        cache()->forget('orders');

        // Delete from taken
        if ($order->isTakenBy(user())) {
            $order->update(['user_id' => null]);

            return redirect('admin/orders')->withSuccess(
                trans('messages.you_deleted_the_order', [
                    'order' => $order->id,
                ])
            );
        }

        // Check if order is already has user
        if ($order->user()->exists()) {
            return redirect('admin/orders')->withError(
                trans('messages.order_already_has_user', [
                    'user' => $order->user->name,
                ])
            );
        }

        $order->update(['user_id' => user()->id]);

        return redirect('admin/orders')->withSuccess(
            trans('messages.you_took_the_order', [
                'order' => $order->id,
            ])
        );
    }

    /**
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function softDelete(Order $order): RedirectResponse
    {
        if ($order->isTakenBy(user())) {
            $order->delete();

            cache()->forget('orders');

            return redirect('/admin/orders')->withSuccess(
                trans('messages.order_closed')
            );
        }
        return redirect('/admin/orders')->withError(
            trans('messages.cant_close_order')
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
