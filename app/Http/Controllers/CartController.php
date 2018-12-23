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

    /**
     * Add cart item to favorites and remove from cart
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToFavorite(string $id): RedirectResponse
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $dublicates = Cart::instance('favorite')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($dublicates->isNotEmpty()) {
            return back()->withError(trans('cart.item_is_in_favorite'));
        }

        Cart::instance('favorite')
            ->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Models\Item');

        return back()->withSuccess(
            trans('cart.added_to_favorite', ['item' => $item->name])
        );
    }

    /**
     * Remove the specified cart item from session
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Cart::remove($id);
        return back()->withSuccess(trans('cart.was_deleted'));
    }
}
