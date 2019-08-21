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
        @include('includes.cards', [
            'cards' => $cards,
            'controls' => auth()->check() && user()->isAdmin(),
        ])
    @endif

    {{-- Home Up Section --}}
    @isset($home_sections[0])
        @include('includes.section', [
            'section' => $home_sections[0],
            'anchor' => 'home_up'
        ])
    @endisset
</div>

<items-api
    hryvnia="@lang('items.hryvnia')"
    headline="@lang('cards.popular')"
    to="/api/item/popular"
></items-api>

<div class="wrapper">
    {{-- Home Down Section --}}
    @isset($home_sections[1])
        @include('includes.section', [
            'section' => $home_sections[1],
            'anchor' => 'home_down',
        ])
    @endisset
</div>

<items-api
    hryvnia="@lang('items.hryvnia')"
    headline="@lang('messages.more_clothes')"

    @if ($admin_options['category1'] && !$admin_options['category2'])
        to="/api/item/random/{{ visitor_id() }}/category1"
    @elseif (!$admin_options['category1'] && $admin_options['category2'])
        to="/api/item/random/{{ visitor_id() }}/category2"
    @else
        to="/api/item/random/{{ visitor_id() }}"
    @endif
></items-api>

@endsection
