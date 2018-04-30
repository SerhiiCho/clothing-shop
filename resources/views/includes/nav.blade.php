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

<!-- Popup window -->
<div id="overlay"></div>
<div id="popup-callback">
	<div id="aim-for-message"></div>
	<form id="clothingshopContactForm" action="#" method="post" class="callback-form" data-url="">
		<label for="name">@lang('navigation.your_name'):</label>
		<input id="name" name="name" type="text" placeholder="@lang('navigation.name')" required="required" />
		<input id="number" name="number" type="tel" value="+380" placeholder="@lang('navigation.number')" required="required" />
		<input type="submit" value="@lang('navigation.send')" style="cursor:pointer;">
		<a href="#" title="@lang('navigation.close')" id="close-popup-form-btn">@lang('navigation.close')</a>
	</form>
</div>

<!-- Header -->
<header>
	<a href="/" title="@lang('navigation.home')" class="header-logo">@lang('navigation.shop_name')</a>

	<!-- Header search form -->
	<form role="search" method="get" id="searchform" class="header-search" action="">
		<input type="search" value="" name="s" placeholder="@lang('navigation.search')"/>
		<input type="submit" id="searchsubmit" style="display:none;" />
	</form>

	<a href="#" title="Перезвоните мне" id="header-callback" class="nav-and-header-btns">
		@lang('navigation.callback')
	</a>
</header>

<nav id="nav-menu" class="top-nav">
	<ul>
		<a href="/" title="Главная" class="nav-logo">@lang('navigation.shop_name')</a>
		<li class="nav-search">
			<form role="search" method="get" id="searchform" class="header-search" action="">
				<input type="search" value="" name="s" placeholder="@lang('navigation.search')" />
				<input type="submit" id="searchsubmit" style="display:none;" />
			</form>
		</li>
		<li class="{{ activeIfRouteIs('/') }}">
			<a href="/">@lang('navigation.home')</a>
		</li>
		<li class="{{ activeIfRouteIs('items', 'men') }}">
			<a href="/items?category=men">@lang('navigation.men')</a>
		</li>
		<li class="{{ activeIfRouteIs('items', 'women') }}">
			<a href="/items?category=women">@lang('navigation.women')</a>
		</li>

		<a href="#" title="@lang('navigation.callback')" class="nav-and-header-btns" id="nav-callback">
			@lang('navigation.callback')
		</a>
		<a href="#" title="@lang('navigation.close')" id="close-nav-menu" class="close-top-nav">
			@lang('navigation.close')
		</a>
	</ul>
</nav>