@extends('layouts.app')

@section('title', $item_title ?? '')

@section('content')

<div class="single-container container">
	<single-item
		:admin={{ json_encode(optional(auth()->user())->admin) }}
		:numberitem="{{ json_encode(trans('items.number_item')) }}"
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
		:phonenumber="{{ json_encode(trans('items.phone_number')) }}"
		:order="{{ json_encode(trans('items.order')) }}"
		:deleting="{{ json_encode(trans('items.delete')) }}"
		:change="{{ json_encode(trans('items.change')) }}"
		:wewillcontactyou="{{ json_encode(trans('items.we_will_contact_you')) }}"
		:youalreadysendorder="{{ json_encode(trans('items.you_already_send_order')) }}"
		:phonenumberincorrect="{{ json_encode(trans('items.phone_number_incorrect')) }}"
		:deletethisphonenuber="{{ json_encode(trans('items.delete_this_phone_nuber')) }}"
	></single-item>
</div>

<!-- Sidebar -->
<div class="col-12 sidebar">
	<h5 class="text-center pt-2 font-weight-normal">@lang('messages.more_clothes')</h5>
	<sidebar
		:hryvnia="{{ json_encode(trans('items.hryvnia')) }}"
		:itemid="{{ json_encode($item_id ?? '') }}"
	></sidebar>
</div>

@endsection