<footer class="pb-5">
	<div class="container">
		<div class="row">
			<nav class="col-6 col-md-4">
				<h4>@lang('navigation.menu')</h4>
				<ul>
					<li><a href="/">@lang('navigation.home')</a></li>
					<li><a href="/items/men">@lang('navigation.men')</a></li>
					<li><a href="/items/women">@lang('navigation.women')</a></li>
				</ul>
			</nav>
			<nav class="col-6 col-md-4">
				<h4>@lang('navigation.last_posts')</h4>
				<ul>
					@foreach ($last_items_for_footer as $item)
						<li>
							<a href="/item/{{ $item->id }}" title="{{ $item->title }}">
								{{ $item->title }}
							</a>
						</li>
					@endforeach
				</ul>
			</nav>

			<div class="col-12 col-md-4 languages">
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
		<div class="row">
			<h6 class="col-12 pt-5 text-center copyright">
				{{ date('Y') }} &copy; @lang('navigation.shop_name')
			</h6>
		</div>
	</div>
</footer>