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

    <items-api
        hryvnia="@lang('items.hryvnia')"
        headline="@lang('cards.popular')"
        to="/api/item/popular"
    ></items-api>

    {{-- Home Section --}}
    @isset($home_section)
        <section>
            @if (!empty($home_section['title']))
                <h3 class="display-4 text-center p-4">
                    {{ $home_section['title'] }}
                </h3>
            @endif
            @if (!empty($home_section['content']))
                <p class="text-justify px-5 pb-5" style="font-size:1.2em">
                    {{ $home_section['content'] }}
                </p>
            @endif
        </section>
    @endisset
</div>

@endsection
