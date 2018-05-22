@extends('layouts.app')

@section('title', trans('items.all_items'))

@section('content')

<div class="wrapper">
	<section class="row">
		<items-sidebar></items-sidebar>
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