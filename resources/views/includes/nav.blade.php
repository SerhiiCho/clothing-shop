<div class="hamburger-up" id="hamburger-container">
    <div id="hamburger">
        <i>
            <span class="lines line1"></span>
            <span class="lines line2"></span>
            <span class="lines line3"></span>
        </i>
    </div>
    <a href="/" 
        title="@lang('navigation.home')"
        id="logo-clothing" 
        style="color:#000;"
    >
        {{ config('app.name') }}
    </a>
</div>

<!-- Header -->
<header class="wrapper">
    <a href="/" title="@lang('navigation.home')" class="header-logo">
        {{ config('app.name') }}
    </a>
    @include('includes.search-form')
        <div class="ml-5">@include('includes.cart')</div>
</header>

<nav id="nav-menu" class="top-nav">
    <ul>
        <a href="/" title="@lang('navigation.home')" class="nav-logo">
            {{ config('app.name') }}
        </a>

        {{-- Mobile search form --}}
        <li class="nav-search" title="@lang('navigation.search')">
            @include('includes.search-form')
        </li>

        <li class="hide-on-desktop">@include('includes.cart')</li>

        {{-- Home --}}
        <li class="{{ activeIfRouteIs('/') }}" title="@lang('navigation.home')">
            <a href="/">@lang('navigation.home')</a>
        </li>

        {{-- Items / men --}}
        @if ($admin_options['men_category'])
            <li class="{{ activeIfRouteIs('items', 'category', 'men') }}" 
                title="@lang('navigation.men')"
            >
                <a href="/items?category=men">
                    @lang('navigation.men')
                </a>
            </li>
        @endif

        {{-- Items / women --}}
        @if ($admin_options['women_category'])
            <li class="{{ activeIfRouteIs('items', 'category', 'women') }}" 
                title="@lang('navigation.women')"
            >
                <a href="/items?category=women">@lang('navigation.women')</a>
            </li>
        @endif

        {{-- Close mobile nav menu button --}}
        <a href="#" 
            title="@lang('navigation.close')" 
            id="close-nav-menu"
            class="btn btn-outline-dark close-top-nav mt-3"
        >
            @lang('navigation.close')
        </a>
    </ul>
</nav>