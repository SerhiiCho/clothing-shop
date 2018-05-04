@extends('layouts.app')

@section('content')

	<banner></banner>

	<!-- 3 Cards -->
	@if ($cards->count() > 0)
		<h3 class="display-4 text-center p-4">@lang('cards.season_categories')</h3>
		<div class="row center three-cards">
			@foreach ($cards as $card)
				<div class="col-12 col-md-4 one-card">
					<img src="{{ asset('storage/img/cards/'. $card->image) }}" alt="">
					<a href="/items?type={{ $card->type_id }}" title="{{ $card->type->name }}" class="card-btn">
						<span>{{ $card->type->name }}</span>
					</a>
				</div>
			@endforeach
		</div>
	@endif

	<!-- Content -->
	<section class="main-content">
		<h3 class="display-4  text-center p-4" style="background:#F2F2F2;">@lang('cards.popular')</h3>
		<div class="container">
			<popular :hryvnia="{{ json_encode(trans('items.hryvnia')) }}"></popular>
		</div>
	</section>

@endsection