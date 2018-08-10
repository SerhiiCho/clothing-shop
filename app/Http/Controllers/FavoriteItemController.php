<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;

class FavoriteItemController extends Controller
{
    public function addToCart($id)
    {
        $item = Cart::instance('favorite')->get($id);

        Cart::instance('favorite')->remove($id);

        $dublicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($dublicates->isNotEmpty()) {
            return back()->withError(trans('cart.item_is_in_your_cart'));
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Models\Item');

        return back()->withSuccess(
            trans('cart.moved_to_cart', ['item' => $item->name])
        );
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        Cart::instance('favorite')->remove($id);
        return back()->withSuccess(trans('cart.was_deleted_from_favs'));
    }
}
