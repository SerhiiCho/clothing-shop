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

    <section v-cloak class="v-cloak">
        <h3 class="display-4 text-center p-4" style="background:#F2F2F2">
            @lang('cards.popular')
        </h3>
    </section>
    <popular
        hryvnia="@lang('items.hryvnia')"
        popular="@lang('cards.popular')">
    </popular>
</div>

@endsection
