@extends('layouts.app')

@section('title', trans('items.all_items'))

@section('content')

<div class="wrapper pb-3">
	<section class="row">
		<div class="col-md-3 items-sidebar">
			<div class="list-group mb-5">
				{{-- Categories --}}
				<h4 class="list-group-item text-center {{ activeIfRouteIs('items', 'category', $current_category) }}">
					@lang('navigation.types')
				</h4>
				@isset($categories)
					@foreach ($categories as $item)
						<a href="/items?category={{ $current_category }}&type={{ $item->type->id }}" class="list-group-item {{ activeIfRouteIs('items', 'type', $item->type->id) }}">
							{{ $item->type->name }}
						</a>
					@endforeach
				@endisset
			</div>
		</div>

		<items
			:womenitems="{{ json_encode(trans('items.women_items')) }}"
			:admin={{ json_encode(optional(auth()->user())->admin) }}
			:menitems="{{ json_encode(trans('items.men_items')) }}"
			:allitems="{{ json_encode(trans('items.all_items')) }}"
			:category="{{ json_encode(trans('items.category')) }}"
			:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
			:deleting="{{ json_encode(trans('items.delete')) }}"
			:change="{{ json_encode(trans('items.change')) }}"
		></items>
	</section>
</div>

@endsection