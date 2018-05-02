<footer>
	<div class="row pl-2 pr-2">
		<nav class="col-6 col-md-4 center">
			<h4>@lang('navigation.menu')</h4>
			<ul>
				<li><a href="/">@lang('navigation.home')</a></li>
				<li><a href="/items/men">@lang('navigation.men')</a></li>
				<li><a href="/items/women">@lang('navigation.women')</a></li>
			</ul>
		</nav>
		<nav class="col-6 col-md-4 center">
			<h4>@lang('navigation.last_posts')</h4>

			<ul>
				<li><a href="#" title="#">Test 1</a></li>
				<li><a href="#" title="#">Test 2</a></li>
				<li><a href="#" title="#">Test 3</a></li>
				<li><a href="#" title="#">Test 4</a></li>
			</ul>
		</nav>

		<div class="col-12 col-md-4 languages center">
			<h4>@lang('navigation.available_languages')</h4>

			<a href="/language/en" title="English">
				<img src="{{ asset('storage/img/en.png') }}" alt="English">
				<span>English</span>
			</a>
			<a href="/language/ru" title="Русский">
				<img src="{{ asset('storage/img/ru.png') }}" alt="Русский">
				<span>Русский</span>
			</a>
		</div>
	</div>
	<h6 class="center copyright">
		{{ date('Y') }} &copy; @lang('navigation.shop_name')
	</h6>
</footer>