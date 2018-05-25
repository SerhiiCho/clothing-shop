@extends('layouts.app')

@section('title', trans('user-sidebar.work'))

@section('content')
<div class="container">
	<h4 class="text-center p-3">@lang('dashboard.your_orders'):</h4>
	<clients-orders
		:admin="{{ json_encode(user()->admin) }}"
		:sum="{{ json_encode(trans('dashboard.sum')) }}"
		:date="{{ json_encode(trans('dashboard.date')) }}"
		:number="{{ json_encode(trans('dashboard.number')) }}"
		:product="{{ json_encode(trans('dashboard.product')) }}"
		:noorders="{{ json_encode(trans('dashboard.no_orders')) }}"
		:deletenumber="{{ json_encode(trans('dashboard.delete_number')) }}"
		:deletethisorder="{{ json_encode(trans('dashboard.delete_this_order')) }}"
	></clients-orders>
</div>
@endsection
