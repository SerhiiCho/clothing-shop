@extends('layouts.app')

@section('title', trans('messages.welcome'))

@section('content')

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-10 pr-0 main-slider text-center" v-if="false">
                <div class="loader mt-5"></div>
            </div>
            <slider></slider>
            <cards></cards>
        </div>
    </div>

    <!-- 3 Cards -->
    @if (isset($cards) && count($cards) > 0)
        <h3 class="display-4 text-center p-4">
            @lang('cards.season_categories')
        </h3>

        <div class="row center three-cards">
            @foreach ($cards as $card)
                <div class="col-12 col-md-4 one-card">
                    <img src="{{ asset("storage/img/big/cards/{$card['image']}") }}" 
                        alt="{{ $card['type']['name'] }}"
                    />

                    <a href="/items?category={{ $card['category'] }}&type={{ $card['type_id'] }}" 
                        title="{{ $card['type']['name'] }}" 
                        class="card-btn"
                    >
                        <span>{{ $card['type']['name'] }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Home Up Section --}}
    @isset($home_sections[0])
        @include('includes.section', [
            'section' => $home_sections[0],
            'anchor' => 'home_up'
        ])
    @endisset

    <items-api
        hryvnia="@lang('items.hryvnia')"
        headline="@lang('cards.popular')"
        to="/api/item/popular"
    ></items-api>

    {{-- Home Down Section --}}
    @isset($home_sections[1])
        @include('includes.section', [
            'section' => $home_sections[1],
            'anchor' => 'home_down',
        ])
    @endisset

    <items-api
        hryvnia="@lang('items.hryvnia')"
        headline="@lang('messages.more_clothes')"

        @if ($admin_options['men_category'] && !$admin_options['women_category'])
            to="/api/item/random/men"
        @elseif (!$admin_options['men_category'] && $admin_options['women_category'])
            to="/api/item/random/women"
        @else
            to="/api/item/random"
        @endif
    ></items-api>
</div>

@endsection
