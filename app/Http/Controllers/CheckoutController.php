<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use Cart;
use Darryldecode\Cart\Exceptions\InvalidConditionException;
use Darryldecode\Cart\Exceptions\InvalidItemException;
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
        return (Cart::isEmpty())
        ? redirect('/cart')
        : view('checkout.index');
    }

    /**
     * Handle the client's order and save in database
     *
     * @param \App\Http\Requests\CheckoutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(CheckoutRequest $request): RedirectResponse
    {
        if (Order::whereIp($request->ip())->count() > 0) {
            return back()->withError(trans('checkout.already_did_order'));
        }

        try {
            cache()->forget('orders');
            cache()->forget('counted_orders');

            $order = Order::create([
                'ip' => $request->ip(),
                'phone' => $request->phone,
                'name' => $request->name,
                'total' => str_replace(' ', '', Cart::getTotal()),
            ]);

            $item_ids = array_map(function ($item) {
                return $item['id'];
            }, Cart::getContent()->toArray());

            $order->items()->attach($item_ids);

            Cart::clear();

            return redirect('/cart')->withSuccess(trans('checkout.order_sent'));
        } catch (InvalidConditionException | InvalidItemException | QueryException $e) {
            no_connection_error($e, __CLASS__);
            return back();
        }
    }
}
