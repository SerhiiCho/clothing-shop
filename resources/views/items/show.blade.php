@extends('layouts.app')

@section('title', $item_title ?? '')

@section('content')

<div class="single-container container">
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
        you-already-send-order="@lang('items.you_already_send_order')"
    >
        <section class="text-center" style="min-height:500px">
            <div class="loader mt-5"></div>
        </section>
    </single-item>
</div>

<!-- Sidebar -->
<div class="col-12 sidebar pb-4">
    <items-api
        hryvnia="@lang('items.hryvnia')"
        headline="@lang('messages.more_clothes')"
        to="/api/item/random/{{ visitor_id() }}/{{ $item_category }}"
    ></items-api>
</div>

@endsection
