<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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
        $dublicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($dublicates->isNotEmpty()) {
            return back()->withError(
                trans('cart.item_is_in_your_cart', [
                    'item' => $request->title,
                ])
            );
        }

        Cart::add($request->id, $request->title, 1, $request->price)
            ->associate('App\Models\Item');

        return back()->withSuccess(
            trans('cart.added_to_cart', ['item' => $request->title])
        );
    }

    public function addToFavorite($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $dublicates = Cart::instance('favorite')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($dublicates->isNotEmpty()) {
            return back()->withError(trans('cart.item_is_in_favorite'));
        }

        Cart::instance('favorite')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Models\Item');

        return back()->withSuccess(
            trans('cart.added_to_favorite', ['item' => $item->name])
        );
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        Cart::remove($id);
        return back()->withSuccess(trans('cart.was_deleted'));
    }
}
