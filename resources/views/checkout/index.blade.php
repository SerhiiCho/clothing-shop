@extends('layouts.app')

@section('title', trans('checkout.checkout'))

@section('content')
<div class="container pb-5 pt-5">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">@lang('checkout.your_order')</span>
                <span class="badge badge-secondary badge-pill">
                    {{ Cart::getTotalQuantity() }}
                </span>
            </h4>

            <ul class="list-group mb-3">
                @foreach (Cart::getContent() as $item)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">{{ $item->name }}</h6>
                        </div>
                        <span class="text-muted text-right" style="min-width:80px">
                            {{ nice_money_format($item->price) }} @lang('items.hryvnia')
                        </span>
                    </li>
                @endforeach

                <li class="list-group-item d-flex justify-content-between">
                    <span>@lang('cart.total')</span>
                    <strong>{{ nice_money_format(Cart::getTotal()) }} @lang('items.hryvnia')</strong>
                </li>
            </ul>
        </div>

        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">@lang('checkout.your_info')</h4>

            <form action="{{ action('CheckoutController@store') }}" 
                method="post" 
                class="needs-validation" 
                id="prevent-double-submitting"
            >
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">@lang('checkout.name')</label>
                        <input type="text" 
                            class="form-control"
                            id="name" 
                            placeholder="@lang('checkout.name')" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone">@lang('checkout.phone')</label>
                        <input type="text" 
                            class="form-control" 
                            id="phone" 
                            placeholder="@lang('checkout.phone')" 
                            name="phone" 
                            value="{{ old('phone') }}"
                            required
                        >
                    </div>
                </div>
                <hr class="mb-4">

                {{-- Checkout button --}}
                <button class="btn btn-success pull-right pl-5 pr-5" 
                    type="submit" 
                    id="submit-button" 
                >
                    @lang('cart.order')
                </button>

                {{-- Back btn --}}
                <a href="/cart" class="btn" title="@lang('messages.back')">
                    &laquo; @lang('messages.back')
                </a>
            </form>
        </div>
    </div>
</div>
@endsection