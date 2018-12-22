@admin     
    <nav class="user-sidebar">
        <ul>
            <li class="{{ activeIfRouteIs('user/work') }} red-buttons" {{ $unreaded ?? '' }}>
                <a href="/user/work" title="@lang('user-sidebar.work')">
                    <i class="fas fa-suitcase icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.work')</span>
                </a>
            </li>
            <li class="{{ activeIfRouteIs('items/create') }}">
                <a href="/items/create" title="@lang('user-sidebar.add_new_item')">
                    <i class="fas fa-plus-circle icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.add_new_item')</span>
                </a>
            </li>
            <li class="{{ activeIfRouteIs('cards') }}">
                <a href="/cards" title="@lang('user-sidebar.cards')">
                    <i class="fas fa-portrait icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.cards')</span>
                </a>
            </li>
            <li class="{{ activeIfRouteIs('slider') }}">
                <a href="/user/slider" title="@lang('user-sidebar.slider')">
                    <i class="fas fa-images icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.slider')</span>
                </a>
            </li>
            <li class="{{ activeIfRouteIs('contacts') }}">
                <a href="/contacts/create" title="@lang('user-sidebar.contacts')">
                    <i class="fas fa-phone icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.contacts')</span>
                </a>
            </li>
            <li class="{{ activeIfRouteIs('items') }}" >
                <a href="/items" title="@lang('user-sidebar.all_items')">
                    <i class="fas fa-tshirt icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.all_items')</span>
                </a>
            </li>
            <li class="{{ activeIfRouteIs('logs') }}" >
                <a href="/logs" title="@lang('logs.logs')">
                    <i class="fas fa-file-contract icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('logs.logs')</span>
                </a>
            </li>
            <li class="{{ activeIfRouteIs('user/dashboard') }}">
                <a href="/user/dashboard" title="@lang('dashboard.dashboard')">
                    <i class="fas fa-cog icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('dashboard.dash')</span>
                </a>
            </li>
        </ul>
        <li>
            <a href="{{ route('logout') }}" title="@lang('user-sidebar.exit')" id="logout-btn">
                <i class="fas fa-sign-out-alt icon-profile-menu-line" aria-hidden="true"></i>
                <span class="nav-text">@lang('user-sidebar.exit')</span>
            </a>
        </li>
    </nav>

    {{-- logout-form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf <button type="submit"></button>
    </form>
@endadmin
