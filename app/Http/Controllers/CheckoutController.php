<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        return view('checkout.index');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
		$items = [];

		foreach (Cart::content() as $item) {
			array_push($items, $item->name);
		}

		$send = Message::create([
			'ip' => $request->ip(),
			'phone' => $request->phone,
			'name' => $request->name,
			'total' => str_replace(' ', '', Cart::total()),
			'order' => implode(" | ", $items),
		]);

		if ($send) {
			Cart::destroy();
			return redirect('/cart')->withSuccess(trans('checkout.order_sent'));
		} else {
			return redirect('/cart')->withError(trans('checkout.error'));
		}
		
    }
}
