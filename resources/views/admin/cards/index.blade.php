@extends('layouts.app')

@section('title', trans('cards.cards'))

@section('content')

<div class="container">
    <!-- 3 Cards -->
    @if ($cards->count() > 0)
        <h3 class="display-4 text-center pt-3">
            @lang('cards.cards'):
            {{ $cards->count() }} / 3
        </h3>

        <div class="row center three-cards p-3">
            @foreach ($cards as $card)
                <div class="col-12 col-md-4 one-card position-relative">
                    <img src="{{ asset("storage/img/big/cards/{$card->image}") }}"
                        alt="{{ $card->type->name }}"
                    >
                    <a href="/items?category={{ $card->category }}&type={{ $card->type_id }}"
                        title="{{ $card->type->name }}"
                        class="card-btn"
                    >
                        <span>{{ $card->type->name }}</span>
                    </a>

                    {{-- Edit button --}}
                    @admin
                        <a href="/admin/cards/{{ $card->id }}/edit"
                            class="btn btn-primary position-absolute" 
                            title="@lang('cards.change_card')" 
                            style="left:1.8em; bottom:0; opacity:.8"
                        >
                            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>

                        {{-- Delete button --}}
                        <form action="{{ action('Admin\CardController@destroy', ['id' => $card->id]) }}"
                            method="post" 
                            class="position-absolute" 
                            style="right:1.8em; bottom:0; opacity:.8"
                        >
                            @csrf @method('delete')

                            <button type="submit"
                                class="btn btn-primary confirm" 
                                title="@lang('cards.delete_card')"
                                data-confirm="@lang('cards.are_you_sure_you_want_delete')"
                            >
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>
                        </form>
                    @endadmin
                </div>
            @endforeach
        </div>
    @endif

    {{-- Add card btn --}}
    <div class="text-center pb-5">
        <a href="/admin/cards/create" 
            title="@lang('cards.add_card')" 
            class="btn btn-success"
        >
            @lang('cards.add_card')
        </a>
    </div>
</div>

@endsection