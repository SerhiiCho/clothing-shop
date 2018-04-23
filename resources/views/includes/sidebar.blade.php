@author     
	<nav class="user-sidebar">
		<ul>
			<li class="disapear-on-big-screen">
				<a>
					<i class="icon-profile-menu-line"></i>
				</a>
			</li>
			<li>
				<a href="/dashboard" title="Профиль">
					<i class="fa fa-plus-circle icon-profile-menu-line" aria-hidden="true"></i>
					<span>Профиль</span>
				</a>
			</li>
			<li>
				<a href="/recipes/create" title="Добавить рецепт">
					<i class="fa fa-plus-circle icon-profile-menu-line" aria-hidden="true"></i>
					<span>Новый товар</span>
				</a>
			</li>
			<li>
				<a>
					<i class="fa fa-plus-circle icon-profile-menu-line" aria-hidden="true"></i>
					<span>Настройки</span>
				</a>
			</li>

			{{-- Menu Second Level --}}
			<div class="menu-second-level">
				<a href="/settings/general" title="Общие">
					<span>Общие</span>
				</a>
				<a href="/settings/photo" title="Фотография">
					<span>Фотография</span>
				</a>
			</div>
		</ul>
		<li>
			<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Выйти">
				<i class="fa fa-plus-circle icon-profile-menu-line" aria-hidden="true"></i>
				<span class="nav-text">Выйти</span>
			</a>
		</li>
	</nav>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
		@csrf
	</form>
@endauthor
