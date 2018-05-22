@extends('layouts.app')

@section('title', $item_title ?? '')

@section('content')

<div class="single-container container">
	<single-item
		:admin={{ json_encode(optional(auth()->user())->admin) }}
		:number-item="{{ json_encode(trans('items.number_item')) }}"
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
		:add-to-cart="{{ json_encode(trans('items.add_to_cart')) }}"
		:deleting="{{ json_encode(trans('items.delete')) }}"
		:change="{{ json_encode(trans('items.change')) }}"
		:token="{{ json_encode(csrf_token()) }}"
		:added-to-cart="{{ json_encode(trans('items.added_to_cart')) }}"
		:you-already-send-order="{{ json_encode(trans('items.you_already_send_order')) }}"
		:delete-this-product="{{ json_encode(trans('items.delete_this_product')) }}"
	></single-item>
</div>

<!-- Sidebar -->
<div class="col-12 sidebar pb-4">
	<h5 class="text-center pt-2 font-weight-normal">@lang('messages.more_clothes')</h5>
	<sidebar
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
		:itemid="{{ json_encode($item_id ?? '') }}"
	></sidebar>
</div>

@endsection