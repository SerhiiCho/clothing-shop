@auth     
    <nav class="user-sidebar">
        <ul>
            <li class="{{ activeIfRouteIs('user/dashboard') }}">
                <a href="/user/dashboard" title="@lang('user-sidebar.profile')">
                    <i class="fa fa-user-circle-o icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.profile')</span>
                </a>
            </li>
            @member
                <li class="{{ activeIfRouteIs('user/work') }} red-buttons" {{ $unreaded ?? '' }}>
                    <a href="/user/work" title="@lang('user-sidebar.work')">
                        <i class="fa fa-suitcase icon-profile-menu-line" aria-hidden="true"></i>
                        <span>@lang('user-sidebar.work')</span>
                    </a>
                </li>
                <li class="{{ activeIfRouteIs('items/create') }}">
                    <a href="/items/create" title="@lang('user-sidebar.add_new_item')">
                        <i class="fa fa-plus-circle icon-profile-menu-line" aria-hidden="true"></i>
                        <span>@lang('user-sidebar.add_new_item')</span>
                    </a>
                </li>
                <li class="{{ activeIfRouteIs('cards') }}">
                    <a href="/cards" title="@lang('user-sidebar.cards')">
                        <i class="fa fa-file-image-o icon-profile-menu-line" aria-hidden="true"></i>
                        <span>@lang('user-sidebar.cards')</span>
                    </a>
                </li>
                <li class="{{ activeIfRouteIs('slider') }}">
                    <a href="/slider" title="@lang('user-sidebar.slider')">
                        <i class="fa fa-picture-o icon-profile-menu-line" aria-hidden="true"></i>
                        <span>@lang('user-sidebar.slider')</span>
                    </a>
                </li>
                <li class="{{ activeIfRouteIs('contacts') }}">
                    <a href="/contacts/create" title="@lang('user-sidebar.contacts')">
                        <i class="fa fa-phone icon-profile-menu-line" aria-hidden="true"></i>
                        <span>@lang('user-sidebar.contacts')</span>
                    </a>
                </li>
            @endmember
            <li class="{{ activeIfRouteIs('items') }}" >
                <a href="/items" title="@lang('user-sidebar.all_items')">
                    <i class="fa fa-shopping-bag icon-profile-menu-line" aria-hidden="true"></i>
                    <span>@lang('user-sidebar.all_items')</span>
                </a>
            </li>
            @master
                <li class="{{ activeIfRouteIs('logs') }}" >
                    <a href="/logs" title="@lang('logs.logs')">
                        <i class="fa fa-question-circle-o icon-profile-menu-line" aria-hidden="true"></i>
                        <span>@lang('logs.logs')</span>
                    </a>
                </li>
            @endmaster
        </ul>
        <li>
            <a href="{{ route('logout') }}" title="@lang('user-sidebar.exit')" id="logout-btn">
                <i class="fa fa-power-off icon-profile-menu-line" aria-hidden="true"></i>
                <span class="nav-text">@lang('user-sidebar.exit')</span>
            </a>
        </li>
    </nav>

    {{-- logout-form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf <button type="submit"></button>
    </form>
@endauth
