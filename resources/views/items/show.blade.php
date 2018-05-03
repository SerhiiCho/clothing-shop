@extends('layouts.app')

@section('content')

<div class="single-container container">
	<single-item
		:admin={{ json_encode(optional(auth()->user())->admin) }}
		:numberitem="{{ json_encode(trans('items.number_item')) }}"
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
	></single-item>
</div>

<!-- Sidebar -->
<div class="col-12 sidebar">
	<section class="heading">@lang('messages.more_clothes')</section>
	<sidebar
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
		:itemid="{{ json_encode($itemId) }}"
	></sidebar>
</div>

@endsection