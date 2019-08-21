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
    <div class="header-search">
        @include('includes.search-form')
    </div>
    <div class="ml-5">
        @include('includes.cart')
    </div>
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
        <li class="{{ active_if_route_is('/') }}" title="@lang('navigation.home')">
            <a href="/">@lang('navigation.home')</a>
        </li>

        {{-- Items / first category --}}
        @if ($admin_options['category1'])
            <li class="{{ active_if_route_is('items', 'category', 'category1') }}">
                <a href="/items?category=category1">
                    {{ $admin_options['category1_title'] }}
                </a>
            </li>
        @endif

        {{-- Items / second category --}}
        @if ($admin_options['category2'])
            <li class="{{ active_if_route_is('items', 'category', 'category2') }}">
                <a href="/items?category=category2">
                    {{ $admin_options['category2_title'] }}
                </a>
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