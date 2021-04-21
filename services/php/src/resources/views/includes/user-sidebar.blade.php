@admin
    <nav class="user-sidebar">
        <ul>
            <li class="{{ active_if_route_is('items/create') }}">
                <a href="/items/create" title="@lang('user-sidebar.add_new_item')">
                    <i class="fas fa-plus-circle icon-profile-menu-line"></i>
                    <span>@lang('user-sidebar.add_new_item')</span>
                </a>
            </li>

            <li class="{{ active_if_route_is('admin/orders') }}">
                <a href="/admin/orders" title="@lang('user-sidebar.orders')">
                    @if ($orders > 0)
                        <span class="badge badge-danger position-absolute red-button">{{ $orders }}</span>
                    @endif
                    <i class="fas fa-envelope icon-profile-menu-line"></i>
                    <span>@lang('user-sidebar.orders')</span>
                </a>
            </li>

            <li class="{{ active_if_route_is('admin/cards') }}">
                <a href="/admin/cards" title="@lang('user-sidebar.cards')">
                    <i class="fas fa-portrait icon-profile-menu-line"></i>
                    <span>@lang('user-sidebar.cards')</span>
                </a>
            </li>

            <li class="{{ active_if_route_is('slider') }}">
                <a href="/admin/slider" title="@lang('user-sidebar.slider')">
                    <i class="fas fa-images icon-profile-menu-line"></i>
                    <span>@lang('user-sidebar.slider')</span>
                </a>
            </li>

            <li class="{{ active_if_route_is('contacts') }}">
                <a href="/admin/contacts" title="@lang('user-sidebar.contacts')">
                    <i class="fas fa-phone icon-profile-menu-line"></i>
                    <span>@lang('user-sidebar.contacts')</span>
                </a>
            </li>

            @master
                <li class="{{ active_if_route_is('users') }}">
                    <a href="/master/users" title="@lang('users.users')">
                        @if ($non_admin_users > 0)
                            <span class="badge badge-danger position-absolute red-button">
                                {{ $non_admin_users }}
                            </span>
                        @endif
                        <i class="fas fa-users icon-profile-menu-line"></i>
                        <span>@lang('users.users')</span>
                    </a>
                </li>
            @endmaster

            <li class="{{ active_if_route_is('logs') }}" >
                <a href="/logs" title="@lang('logs.logs')">
                    <i class="fas fa-file-contract icon-profile-menu-line"></i>
                    <span>@lang('logs.logs')</span>
                </a>
            </li>

            <li class="{{ active_if_route_is('admin/dashboard') }}">
                <a href="/admin/dashboard" title="@lang('dashboard.dashboard')">
                    <i class="fas fa-wrench icon-profile-menu-line"></i>
                    <span>@lang('dashboard.dash')</span>
                </a>
            </li>

            <li class="{{ active_if_route_is('admin/table') }}">
                <a href="/admin/table" title="@lang('table.table')">
                    <i class="fas fa-table icon-profile-menu-line"></i>
                    <span>@lang('table.table')</span>
                </a>
            </li>
        </ul>

        <li>
            <a href="{{ route('logout') }}" title="@lang('user-sidebar.exit')" id="logout-btn">
                <i class="fas fa-sign-out-alt icon-profile-menu-line"></i>
                <span class="nav-text">@lang('user-sidebar.exit')</span>
            </a>
        </li>
    </nav>

    {{-- logout-form --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf <button type="submit"></button>
    </form>
@endadmin
