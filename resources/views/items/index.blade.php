@extends('layouts.app')

@section('title', whatIsCurrent('title'))

@section('content')

<div class="wrapper pb-3">
    <div class="container">
        <section class="row">
            @if ($sidebar)
                <div class="col-md-3 items-sidebar">
                    <div class="list-group mb-5">
                        {{-- Categories --}}
                        <h4 class="list-group-item text-center active">
                            @lang('navigation.types')
                        </h4>
                        @if($current_category == 'women' && isset($categories_women))
                            @foreach ($categories_women as $item)
                                <a href="/items?category={{ $current_category }}&type={{ $item->type->id }}" 
                                    class="list-group-item {{ activeIfRouteIs('items', 'type', $item->type->id) }}"
                                >
                                    {{ $item->type->name }}
                                </a>
                            @endforeach
                        @elseif ($current_category == 'men' && isset($categories_men))
                            @foreach ($categories_men as $item)
                                <a href="/items?category={{ $current_category }}&type={{ $item->type->id }}" 
                                    class="list-group-item {{ activeIfRouteIs('items', 'type', $item->type->id) }}"
                                >
                                    {{ $item->type->name }}
                                </a>
                            @endforeach
                        @endisset
                    </div>
                </div>
            @endif
    
            <div class="col-md-{{ $sidebar ? '9' : '10 offset-md-1' }}">
                <section class="display-4 p-4 text-center">
                    {{ whatIsCurrent('title') }}
                </section>

                @if ($sidebar)
                    <categories-button
                        categories="@lang('navigation.types')">
                    </categories-button>
                @endif

                <items
                    admin="{{ optional(auth()->user())->admin }}"
                    all-items="@lang('items.all_items')"
                    category="@lang('items.category')"
                    hryvnia="@lang('items.hryvnia')"
                    deleting="@lang('cart.delete')"
                    change="@lang('items.change')">
                </items>
            </div>
        </section>
    </div>
</div>

@endsection