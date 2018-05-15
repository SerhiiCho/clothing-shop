<a
	href="/cart"
	class="text-dark cart"
	@if (Cart::instance('default')->count() > 0)
		data="{{ Cart::instance('default')->count() }}"
	@endif
>
	<i class="fa fa-shopping-cart" aria-hidden="true"></i> 
		@lang('cart.cart')
</a>