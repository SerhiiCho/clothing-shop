@extends('layouts.app')

@section('title', trans('cards.cards'))

@section('content')

<div class="container">
    <!-- 3 Cards -->
    @if (count($cards) > 0)
        <h3 class="display-4 text-center py-3">
            @lang('cards.cards'):
            {{ count($cards) }} / 3
        </h3>

        @include('includes.cards', [
            'cards' => $cards,
            'controls' => true,
        ])

    @else
        <p class="text-center py-4">@lang('cards.no_cards')</p>
    @endif

    {{-- Add card btn --}}
    @if (count($cards) < 3)
        <div class="text-center pb-4">
            <a href="/admin/cards/create" 
                title="@lang('cards.add_card')" 
                class="btn btn-success"
            >
                @lang('cards.add_card')
            </a>
        </div>
    @endif
</div>

@endsection