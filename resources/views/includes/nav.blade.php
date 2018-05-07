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
<header>
	<a href="/" title="@lang('navigation.home')" class="header-logo">
		@lang('navigation.shop_name')
	</a>

	{{-- <form role="search" method="get" id="searchform" class="header-search" action="">
		<input type="search" value="" name="s" placeholder="@lang('navigation.search')"/>
		<input type="submit" id="searchsubmit" style="display:none;" />
	</form> --}}
</header>

<nav id="nav-menu" class="top-nav">
	<ul>
		<a href="/" title="Главная" class="nav-logo">@lang('navigation.shop_name')</a>
		{{-- <li class="nav-search">
			<form role="search" method="get" id="searchform" class="header-search" action="">
				<input type="search" value="" name="s" placeholder="@lang('navigation.search')" />
				<input type="submit" id="searchsubmit" style="display:none;" />
			</form>
		</li> --}}
		<li class="{{ activeIfRouteIs('/') }}">
			<a href="/">@lang('navigation.home')</a>
		</li>
		<li class="{{ activeIfRouteIs('items', 'men') }}">
			<a href="/items?category=men">@lang('navigation.men')</a>
		</li>
		<li class="{{ activeIfRouteIs('items', 'women') }}">
			<a href="/items?category=women">@lang('navigation.women')</a>
		</li>

		<a href="#" title="@lang('navigation.close')" id="close-nav-menu" class="btn btn-outline-dark close-top-nav mt-3">
			@lang('navigation.close')
		</a>
	</ul>
</nav>