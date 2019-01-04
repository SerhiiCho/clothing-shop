<?php

namespace App\Http\Controllers;

use Cart;
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
        if (Cart::get($request->id)) {
            return back()->withError(trans('cart.item_is_in_your_cart'));
        }

        Cart::add($request->id, $request->title, $request->price, 1, [
            'slug' => $request->slug,
            'category' => $request->category,
            'photo' => $request->photo,
        ]);

        return back()->withSuccess(trans('cart.added_to_cart', [
            'item' => $request->title,
        ]));
    }

    /**
     * Remove the specified cart item from session
     *
     * @param string $item_id The id of a cart item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $item_id): RedirectResponse
    {
        Cart::remove($item_id);
        return back()->withSuccess(trans('cart.was_deleted'));
    }
}
