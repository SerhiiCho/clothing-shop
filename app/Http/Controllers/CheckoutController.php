<?php

namespace App\Http\Controllers;

use App\Events\RecivedOrdeEvent;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    /**
     * If client didn't make the order, redirect to cart page
     *
     * @return mixed
     */
    public function index()
    {
        return (Cart::instance('default')->count() > 0)
        ? view('checkout.index')
        : redirect('/cart');
    }

    /**
     * Handle the client's order and save in database
     *
     * @param \App\Http\Requests\CheckoutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CheckoutRequest $request): RedirectResponse
    {
        if (Order::whereIp($request->ip())->count() > 0) {
            return back()->withError(trans('checkout.olready_did_order'));
        }

        try {
            $order = Order::create([
                'ip' => $request->ip(),
                'phone' => $request->phone,
                'name' => $request->name,
                'total' => str_replace(' ', '', Cart::total()),
            ]);

            $item_ids = array_map(function ($item) {
                return $item['id'];
            }, Cart::content()->toArray());

            $order->items()->attach($item_ids);
            Cart::instance('default')->destroy();

            event(new RecivedOrdeEvent($request->phone));

            return redirect('/cart')->withSuccess(
                trans('checkout.order_sent')
            );
        } catch (Exception | QueryException $e) {
            logger()->error($e->getMessage());
            return back()->withError(trans('checkout.error'));
        }
    }
}
