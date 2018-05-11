<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        return view('cart.index');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
		Cart::add($request->id, $request->title, 1, $request->price)
			->associate('App\Models\Item');

		return back()->withSuccess(trans('cart.added_to_cart'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        //
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
		Cart::remove($id);
		return back()->withSuccess(trans('cart.was_deleted'));
    }
}
