@extends('layouts.app')

@section('title', trans('search.search'))

@section('content')

<div class="container pb-5">
    <h3 class="display-4 p-3 text-center">@lang('search.search')</h3>
    <div class="text-center pb-4">@include('includes.search-form')</div>

    @isset($result)
        <div class="row">
            @forelse ($result as $item)
                <div class="col-lg-2 col-md-3 col-6 col-sm-4 item-card">
                    <a href="item/{{ $item->category }}/{{ $item->slug }}" title="{{ $item->title }}">
                        <img src="{{ asset("storage/img/small/clothes/{$item->photos()->first()->name}") }}" 
                            alt="{{ $item->title }}"
                        />
                    </a>
                    <div class="item-card-price">
                        <span>{{ $item->title }}</span>
                        <span class="hryvnia">{{ $item->price }} @lang('items.hryvnia')</span>
                    </div>
                </div>
            @empty
                <div class="card-block col-12 m-3">
                    <p class="card-text text-center">
                        @lang('search.nothing_was_found', ['word' => $word])
                    </p>
                </div>
            @endforelse

            <!-- Pagination -->
            <nav class="col-12">{{ $result->links() }}</nav>
        </div>
    @endisset
</div>

@endsection