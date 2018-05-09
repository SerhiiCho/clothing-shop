@extends('layouts.app')

@section('title', trans('search.search'))

@section('content')

<div class="container pb-5">
	<section class="display-4 p-3 text-center">@lang('search.search')</section>

	<div class="text-center">@include('includes.search-form')</div>

	@isset($result)
	<div class="row">
		@forelse ($result as $item)
		<div class="col-lg-2 col-md-3 col-6 col-sm-4 item-card">
			<a href="item/{{ $item->id }}" title="{{ $item->title }}">
				<img src="{{ asset('storage/img/clothes/' . $item->image) }}" alt="{{ $item->title }}">
			</a>
			<div class="item-card-price">
				<span>{{ $item->title }}</span>
				<span class="hryvnia">{{ $item->price1 }}</span>
				<span class="change">{{ $item->price2 }} @lang('items.hryvnia')</span>
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