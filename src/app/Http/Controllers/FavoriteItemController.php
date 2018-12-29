<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;

class FavoriteItemController extends Controller
{
    /**
     * Switch item from favorites to cart
     *
     * @param string $item_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switchToCart(string $item_id): RedirectResponse
    {
        $cart_item = Cart::instance('favorite')->get($item_id);
        Cart::instance('favorite')->remove($item_id);

        $dublicates = Cart::instance('default')
            ->search(function ($cart_item, $row_id) use ($item_id) {
                return $row_id === $item_id;
            });

        if ($dublicates->isNotEmpty()) {
            return back()->withError(trans('cart.item_is_in_your_cart'));
        }

        Cart::instance('default')
            ->add($cart_item->id, $cart_item->name, 1, $cart_item->price)
            ->associate('App\Models\Item');

        return back()->withSuccess(trans('cart.moved_to_cart', [
            'item' => $cart_item->name,
        ]));
    }

    /**
     * Remove cart item from favorites
     *
     * @param string $item_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $item_id): RedirectResponse
    {
        Cart::instance('favorite')->remove($item_id);
        return back()->withSuccess(trans('cart.was_deleted_from_favs'));
    }
}
