<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('cart.index');
    }

    /**
     * Store a newly created cart item in session
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $dublicates = Cart::search(function ($cart_item, $row_id) use ($request) {
            return $cart_item->id === $request->id;
        });

        if ($dublicates->isNotEmpty()) {
            return back()->withError(trans('cart.item_is_in_your_cart'));
        }

        // id, name, amount and price
        Cart::add($request->id, $request->title, 1, $request->price)
            ->associate('App\Models\Item');

        return back()->withSuccess(trans('cart.added_to_cart', [
            'item' => $request->title,
        ]));
    }

    /**
     * Add cart item to favorites and remove from cart
     *
     * @param string $cart_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToFavorite(string $cart_id): RedirectResponse
    {
        $cart_item = Cart::get($cart_id);
        Cart::remove($cart_id);

        $dublicates = Cart::instance('favorite')
            ->search(function ($cart_item, $row_id) use ($cart_id) {
                return $row_id === $cart_id;
            });

        if ($dublicates->isNotEmpty()) {
            return back()->withError(trans('cart.item_is_in_favorite'));
        }

        Cart::instance('favorite')
            ->add($cart_item->id, $cart_item->name, 1, $cart_item->price)
            ->associate('App\Models\Item');

        return back()->withSuccess(trans('cart.added_to_favorite', [
            'item' => $cart_item->name,
        ]));
    }

    /**
     * Remove the specified cart item from session
     *
     * @param string $rowId The id of a cart item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $rowId): RedirectResponse
    {
        Cart::remove($rowId);
        return back()->withSuccess(trans('cart.was_deleted'));
    }
}
