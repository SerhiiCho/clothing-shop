<a href="/cart" class="text-dark mt-1 cart">
    <i class="fas fa-shopping-cart"></i>  
    @lang('cart.cart')

    @if (!Cart::isEmpty())
        <span class="text-success text-bold d-inline">
            {{ Cart::getTotalQuantity() }}
        </span>
    @endif
</a>