@extends('layouts.app')

@section('title', trans('user-sidebar.orders'))

@section('content')

<div class="container pt-2" id="orders-page">
    <div class="text-center" v-if="false">
        <div class="loader mt-1"></div>
    </div>

    <orders 
        opened-orders="@lang('messages.opened_orders')"
        taken-orders="@lang('messages.taken_orders')"
        closed-orders="@lang('messages.closed_orders')"
        take-order="@lang('messages.take_order')"
        untake-order="@lang('messages.untake_order')"
        close-order="@lang('messages.close_order')"
        delete-order="@lang('messages.delete_order')"
        delete-this-order="@lang('messages.delete_this_order')"
        close-this-order="@lang('messages.close_this_order')"
        client-order="@lang('items.clients_order')"
        number="@lang('dashboard.number')"
        sum="@lang('dashboard.sum')"
        date="@lang('dashboard.date')"
        products="@lang('dashboard.products')"
        hryvnia="@lang('items.hryvnia')"
        taken-by="@lang('messages.taken_by')"
        user-id="{{ user()->id }}"
    ></orders>
</div>

@endsection
