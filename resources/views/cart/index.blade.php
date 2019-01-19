@extends('layouts.app')

@section('title', trans('cart.cart'))

@section('content')

<div class="container">
    @if (!Cart::isEmpty())
        <h4 class="text-center pt-4 pb-3 font-weight-normal">
            @lang('cart.cart')
        </h4>
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">@lang('dashboard.products')</th>
                    <th style="width:20%" class="text-center">
                        @lang('cart.price')
                    </th>
                    <th style="width:30%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::getContent() as $item)
                    <tr>
                        <td>
                            <div class="row">
                                <a href="/item/{{ $item->attributes->category }}/{{ $item->attributes->slug }}"
                                    class="col-12 col-sm-2"
                                >
                                    <img src="{{ asset("storage/img/small/clothes/{$item->attributes->photo}") }}"
                                        alt="{{ $item->name }}"
                                        class="img-responsive" 
                                        style="max-width:50px;"
                                    />
                                </a>
                                <div class="col-12 col-sm-10 pt-2">
                                    <h6 class="nomargin">{{ $item->name }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <h6>{{ $item->price }} @lang('items.hryvnia')</h6>
                        </td>
                        {{-- Remove item --}}
                        <td class="text-center">
                            <form action="{{ action('CartController@destroy', ['item' => $item->id]) }}" 
                                method="post" 
                                class="d-inline"
                            >
                                @csrf @method('delete')

                                <button type="submit"
                                    class="btn btn-success btn-sm" 
                                    title="@lang('cart.delete')"
                                >
                                    @lang('cart.delete')
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            {{-- Table Footer --}}
            <tfoot>
                <tr>
                    <td></td>
                    <td class="hidden-xs text-center">
                        <strong>
                            @lang('cart.total')  {{ Cart::getTotal() }} @lang('items.hryvnia')
                        </strong>
                    </td>
                    <td>
                        <a href="/checkout" class="btn btn-success btn-block">
                            @lang('cart.order') <i class="fas fa-angle-right"></i>
                        </a>
                    </td>
                </tr>
            </tfoot>
        </table>
    @else
        <h5 class="text-center py-5 grey">@lang('cart.empty')</h5>
    @endif
</div>

@endsection