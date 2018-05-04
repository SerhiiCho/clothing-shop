@extends('layouts.app')

@section('content')

<!-- 3 Cards -->
@if ($cards->count() > 0)
	<h3 class="display-4 text-center p-4">@lang('home.season_categories')</h3>
	<div class="row center three-cards">
		@foreach ($cards as $card)
			<div class="col-12 col-sm-4 one-card">
				<img src="{{ asset('storage/img/cards/'. $card->image) }}" alt="">
				<a href="/items?type={{ $card->type_id }}" title="{{ $card->type->type }}" class="card-btn">
					<span>{{ $card->type->type }}</span>
				</a>
			</div>
		@endforeach
	</div>
@endif

@endsection