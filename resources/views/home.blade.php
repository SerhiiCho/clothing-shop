@extends('layouts.app')

@section('title', trans('messages.welcome'))

@section('content')

<div class="wrapper">
	<div class="container">
		<div class="row">
			<slider></slider>
			<cards></cards>
		</div>
	</div>

	<!-- 3 Cards -->
	@if (isset($cards) && $cards->count() > 0)
		<h3 class="display-4 text-center p-4">@lang('cards.season_categories')</h3>
		<div class="row center three-cards">
			@foreach ($cards as $card)
				<div class="col-12 col-md-4 one-card">
					<img src="{{ asset('storage/img/cards/'. $card->image) }}" alt="{{ $card->type->name }}">
					<a href="/items?type={{ $card->type_id }}" title="{{ $card->type->name }}" class="card-btn">
						<span>{{ $card->type->name }}</span>
					</a>
				</div>
			@endforeach
		</div>
	@endif

	<popular
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
		:popular="{{ json_encode(trans('cards.popular')) }}"
	></popular>
</div>

@endsection