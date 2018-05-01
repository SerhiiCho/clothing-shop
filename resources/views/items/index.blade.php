@extends('layouts.app')

@section('content')

<section class="main-content">
	<items
		:womenitems="{{ json_encode(trans('items.women_items')) }}"
		:admin={{ json_encode(optional(auth()->user())->admin) }}
		:menitems="{{ json_encode(trans('items.men_items')) }}"
		:allitems="{{ json_encode(trans('items.all_items')) }}"
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
		:deleting="{{ json_encode(trans('items.delete')) }}"
		:change="{{ json_encode(trans('items.change')) }}"
	></items>
</section>

@endsection