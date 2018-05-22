<div class="hamburger-up" id="hamburger-container">
	<div id="hamburger">
		<i>
			<span class="lines line1"></span>
			<span class="lines line2"></span>
			<span class="lines line3"></span>
		</i>
	</div>
	<a href="/" title="@lang('navigation.home')" id="logo-clothing" style="color:#000;">
		@lang('navigation.shop_name')
	</a>
</div>

<!-- Header -->
<header class="wrapper">
	<a href="/" title="@lang('navigation.home')" class="header-logo">
		@lang('navigation.shop_name')
	</a>
	@include('includes.search-form')
		<div class="ml-5">@include('includes.cart')</div>
</header>

<nav id="nav-menu" class="top-nav">
	<ul>
		<a href="/" title="@lang('navigation.home')" class="nav-logo">@lang('navigation.shop_name')</a>
		<li class="nav-search" title="@lang('navigation.search')">
			@include('includes.search-form')
		</li>
		<li class="hide-on-desktop">@include('includes.cart')</li>
		<li class="{{ activeIfRouteIs('/') }}" title="@lang('navigation.home')">
			<a href="/">@lang('navigation.home')</a>
		</li>
		<li class="{{ activeIfRouteIs('items', 'men') }}" title="@lang('navigation.men')">
			<a href="/items?category=men">@lang('navigation.men')</a>
		</li>
		<li class="{{ activeIfRouteIs('items', 'women') }}" title="@lang('navigation.women')">
			<a href="/items?category=women">@lang('navigation.women')</a>
		</li>

		<a href="#" title="@lang('navigation.close')" id="close-nav-menu" class="btn btn-outline-dark close-top-nav mt-3">
			@lang('navigation.close')
		</a>
	</ul>
</nav>