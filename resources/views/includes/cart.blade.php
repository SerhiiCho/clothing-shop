<a href="/cart" class="text-dark cart">
	<i class="fa fa-shopping-cart" aria-hidden="true"></i>  
	@lang('cart.cart')
</a>

@if (Cart::instance('default')->count() > 0)
	<span class="text-primary text-bold">
		{{ Cart::instance('default')->count() }}
	</span>
@endif