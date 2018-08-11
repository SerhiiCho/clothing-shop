@extends('layouts.app')

@section('title', $item_title ?? '')

@section('content')

<div class="single-container container">
	<img src="/storage/img/clothes/default.jpg" v-cloak class="v-cloak">
	<single-item
		admin="{{ optional(auth()->user())->admin }}"
		token="{{ csrf_token() }}"
		change="@lang('items.change')"
		deleting="@lang('items.delete')"
		hryvnia="@lang('items.hryvnia')"
		add-to-cart="@lang('items.add_to_cart')"
		all-amount1="@lang('items.all_amount_1')"
		all-amount2="@lang('items.all_amount_2')"
		added-to-cart="@lang('items.added_to_cart')"
		code-of-the-item="@lang('items.code_of_the_item')"
		delete-this-product="@lang('items.delete_this_product')"
		you-already-send-order="@lang('items.you_already_send_order')">
	</single-item>
</div>

<!-- Sidebar -->
<div class="col-12 sidebar pb-4">
	<h5 class="text-center pt-2 font-weight-normal">@lang('messages.more_clothes')</h5>
	<sidebar
		hryvnia="@lang('items.hryvnia')"
		item-id="{{ $item_id ?? '' }}">
	</sidebar>
</div>

@endsection
