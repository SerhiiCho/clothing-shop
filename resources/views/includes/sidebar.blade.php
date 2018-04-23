@auth     
	<nav class="user-sidebar">
		<ul>
			<li>
				<a href="/dashboard" title="Профиль">
					<i class="fa fa-user-circle-o icon-profile-menu-line" aria-hidden="true"></i>
					<span>@lang('user-sidebar.profile')</span>
				</a>
			</li>
			<li>
				<a href="#" title="Добавить рецепт">
					<i class="fa fa-plus-circle icon-profile-menu-line" aria-hidden="true"></i>
					<span>@lang('user-sidebar.add_new_item')</span>
				</a>
			</li>
			<li>
				<a>
					<i class="fa fa-cog icon-profile-menu-line" aria-hidden="true"></i>
					<span>@lang('user-sidebar.settings')</span>
				</a>
			</li>

			{{-- Menu Second Level --}}
			<div class="menu-second-level">
				<a href="/settings/general" title="Общие">
					<span>@lang('user-sidebar.general')</span>
				</a>
			</div>
		</ul>
		<li>
			<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Выйти">
				<i class="fa fa-power-off icon-profile-menu-line" aria-hidden="true"></i>
				<span class="nav-text">Выйти</span>
			</a>
		</li>
	</nav>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
		@csrf
	</form>
@endauth
