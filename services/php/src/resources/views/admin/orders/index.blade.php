@extends('layouts.app')

@section('title', trans('user-sidebar.orders'))

@section('content')

<div class="container pt-2">
    <orders inline-template
        opened-orders="@lang('messages.opened_orders')"
        taken-orders="@lang('messages.taken_orders')"
        closed-orders="@lang('messages.closed_orders')"
    >
        <tabs>
            <tab v-for="(tab, i) in tabs"
                :key="tab.hash"
                :name="tabTitle(tab, i)"
                :hash="tab.hash"
                :selected="tab.hash == '#!tab-1'"
            >
                <div class="col-12" v-if="!loading && orders.length <= 0">
                    <h5 class="pt-4 pb-3 text-center">
                        @lang('dashboard.no_orders')
                    </h5>
                </div>
                <div class="row pb-5">
                    <order v-for="(order, i) in orders"
                        :key="i"
                        take-order="@lang('messages.take_order')"
                        untake-order="@lang('messages.untake_order')"
                        close-order="@lang('messages.close_order')"
                        delete-order="@lang('messages.delete_order')"
                        delete-this-order="@lang('messages.delete_this_order')"
                        close-this-order="@lang('messages.close_this_order')"
                        taken-by="@lang('messages.taken_by')"
                        client-order="@lang('items.clients_order')"
                        number="@lang('dashboard.number')"
                        name="@lang('checkout.name')"
                        sum="@lang('dashboard.sum')"
                        date="@lang('dashboard.date')"
                        products="@lang('dashboard.products')"
                        hryvnia="@lang('items.hryvnia')"
                        :color="tab.color"
                        :slug="tab.slug"
                        :order="order"
                        user-id="{{ user()->id }}"
                    ></order>
                </div>

                {{-- Load more --}}
                <div class="col-12 text-center pb-5" v-if="!theEnd">
                    <div class="text-center pt-2 pb-5" v-if="loading">
                        <div class="loader mx-auto"></div>
                    </div>
                    <div v-else class="btn btn-sm btn-success" v-on:click="showMoreOrders()">
                        <i class="fas fa-sync-alt"></i> 
                        @lang('messages.show_else') 
                        <b v-text="countedOrders[i] - orders.length"></b>
                    </div>
                </div>
            </tab>

        </tabs>
    </orders>
</div>

@endsection
