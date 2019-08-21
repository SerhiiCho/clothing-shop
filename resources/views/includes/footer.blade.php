<footer>
    <div class="container">
        <div class="row">

            {{-- Navigation --}}
            <nav class="col-6 col-md-3">
                <h4>@lang('navigation.menu')</h4>
                <ul>
                    <li><a href="/">@lang('navigation.home')</a></li>

                    @if ($admin_options['category1'])
                        <li>
                            <a href="/items?category=category1">
                                {{ $admin_options['category1_title'] }}
                            </a>
                        </li>
                    @endif

                    @if ($admin_options['category2'])
                        <li>
                            <a href="/items?category=category2">
                                {{ $admin_options['category2_title'] }}
                            </a>
                        </li>
                    @endif

                    <li><a href="/search">@lang('navigation.search')</a></li>
                </ul>
            </nav>

            {{-- Last items --}}
            @isset($footer_latest)
                <nav class="col-6 col-md-3">
                    <h4>@lang('navigation.last_posts')</h4>
                    <ul>
                        @foreach ($footer_latest as $item)
                            <li>
                                <a href="/item/{{ $item['category'] }}/{{ $item['slug'] }}"
                                    title="{{ $item['title'] }}"
                                >
                                    {{ $item['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endisset

            {{-- Categories second --}}
            @if (isset($categories2) && $admin_options['category2'])
                <nav class="col-6 col-md-3">
                    <h4>{{ $admin_options['category2_title'] }}</h4>
                    <ul>
                        @foreach ($categories2 as $item)
                        <li>
                            <a href="/items?category={{ $item['category'] }}&type={{ $item['type_id'] }}" 
                                title="{{ $item['type_id'] }}"
                            >
                                {{ $item['type']['name'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            @endif

            {{-- Categories first --}}
            @if (isset($categories1) && $admin_options['category1'])
                <nav class="col-6 col-md-3">
                    <h4>{{ $admin_options['category1_title'] }}</h4>
                    <ul>
                        @foreach ($categories1 as $item)
                        <li>
                            <a href="/items?category={{ $item['category'] }}&type={{ $item['type_id'] }}" 
                                title="{{ $item['type']['name'] }}"
                            >
                                {{ $item['type']['name'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            @endif
        </div>
        <div class="row">
            <h6 class="col-12 pt-5 text-center copyright">
                {{ date('Y') }} &copy; {{ config('app.name') }}
            </h6>
        </div>
    </div>
</footer>