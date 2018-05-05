@extends('layouts.app')

@section('content')
<div class="container">
	<h4 class="text-center p-3">@lang('dashboard.your_orders'):</h4>
	<clients-orders
		:date="{{ json_encode(trans('dashboard.date')) }}"
		:number="{{ json_encode(trans('dashboard.number')) }}"
		:product="{{ json_encode(trans('dashboard.product')) }}"
		:deleting="{{ json_encode(trans('dashboard.deleting')) }}"
		:noorders="{{ json_encode(trans('dashboard.no_orders')) }}"
		:deletenumber="{{ json_encode(trans('dashboard.delete_number')) }}"
		:deletethisorder="{{ json_encode(trans('dashboard.delete_this_order')) }}"
	></clients-orders>
</div>
@endsection
