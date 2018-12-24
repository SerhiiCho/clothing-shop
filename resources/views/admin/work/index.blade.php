@extends('layouts.app')

@section('title', trans('user-sidebar.work'))

@section('content')
<div class="container">
    <h4 class="text-center p-3">@lang('dashboard.your_orders'):</h4>
    <div class="row text-center pb-5" v-if="false">
        <div class="loader mx-auto mt-4"></div>
    </div>
    <clients-orders
        :admin="{{ json_encode(user()->admin) }}"
        sum="@lang('dashboard.sum')"
        clients-order="@lang('items.clients_order')"
        date="@lang('dashboard.date')"
        hryvnia="@lang('items.hryvnia')"
        number="@lang('dashboard.number')"
        products="@lang('dashboard.products')"
        no-orders="@lang('dashboard.no_orders')"
        delete-number="@lang('dashboard.delete_number')"
        delete-this-order="@lang('dashboard.delete_this_order')"
    >
    </clients-orders>
</div>
@endsection
