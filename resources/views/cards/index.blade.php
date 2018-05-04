@extends('layouts.app')

@section('content')

<div class="container">
	<!-- 3 Cards -->
	@if ($cards->count() > 0)
		<h3 class="display-4 text-center">@lang('cards.cards')</h3>
		<div class="row center three-cards p-3">
			@foreach ($cards as $card)
				<div class="col-12 col-sm-4 one-card position-relative">
					<img src="{{ asset('storage/img/cards/'. $card->image) }}" alt="">
					<a href="/items?type={{ $card->type_id }}" title="{{ $card->type->type }}" class="card-btn">
						<span>{{ $card->type->type }}</span>
					</a>

					{{-- Delete button --}}
					<form action="{{ action('CardController@destroy', ['id' => $card->id]) }}" method="post" onsubmit='return confirm("@lang('cards.are_you_sure_you_want_delete')")' class="position-absolute" style="left: 2.5em; bottom: 1.1em;">
						@method('delete')
						@csrf
						<button type="submit" class="btn btn-danger">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</form>
				</div>
			@endforeach
		</div>
	@endif
	<div class="text-center pb-5">
		<div class="alert alert-light mb-3" role="alert">
			@lang('cards.amount_of_cards'): {{ $cards->count() }} / 3
		</div>
		<a href="/cards/create" title="@lang('cards.add_card')" class="btn btn-dark">@lang('cards.add_card')</a>
	</div>
</div>

@endsection