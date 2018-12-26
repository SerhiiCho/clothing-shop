@extends('layouts.app')

@section('title', trans('user-sidebar.work'))

@section('content')

<div class="container">
    <h4 class="text-center py-3">@lang('dashboard.your_orders'):</h4>

    {{-- Tabs --}}
    <ul class="nav nav-tabs nav-fill mb-4">
        <li class="nav-item">
            <a class="nav-link {{ is_null($tab) ? 'active' : '' }}" href="/admin/work">
                @lang('messages.opened_orders') 
                <b style="color:brown">{{ is_null($tab) ? $orders->count() : '' }}</b>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'closed' ? 'active' : '' }}" href="/admin/work/closed">
                @lang('messages.closed_orders')
                <b style="color:brown">{{ $tab == 'closed' ? $orders->count() : '' }}</b>
            </a>
        </li>
    </ul>

    <div class="row pb-5">
        @forelse ($orders as $order)
            <div class="col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card" style="border-top:4px solid {{ $tab == 'closed' ? '#e56114' : 'green' }}">
                    @if ($tab == 'closed')
                        <form action="{{ action('Admin\OrderController@destroy', ['id' => $order->id]) }}" method="post">
                            @csrf @method('delete')
                            <button type="submit"
                                class="py-2 confirm btn btn-sm btn-block"
                                data-confirm="@lang('messages.delete_this_order')"
                                style="background:transparent; color:brown"
                            >
                                <i class="fas fa-trash-alt"></i> @lang('messages.delete_order')
                            </button>
                        </form>
                    @else
                        <form action="{{ action('Admin\OrderController@softDelete', ['id' => $order->id]) }}" method="post">
                            @csrf @method('put')
                            <button type="submit"
                                class="py-2 confirm btn btn-sm btn-block"
                                data-confirm="@lang('messages.close_this_order')"
                                style="background:transparent; color:#e56114"
                            >
                                <i class="fas fa-ban"></i> @lang('messages.close_order')
                            </button>
                        </form>
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">
                            @lang('items.clients_order') # {{ $order->id }}
                        </h6>
                        <hr />
                        <p class="card-text mb-1">
                            @lang('dashboard.number'): 
                            <strong>{{ $order->phone }}</strong>
                        </p>
                        <p class="card-text mb-1">
                            @lang('dashboard.sum'): 
                            <strong>
                                {{ $order->total }} 
                                @lang('items.hryvnia')
                            </strong>
                        </p>
                        <p class="card-text mb-1">
                            @lang('dashboard.date'):
                            <strong>{{ $order->created_at }}</strong>
                        </p>
                        <hr />

                        <div class="text-center">
                            <h6>@lang('dashboard.products'):</h6>
                        </div>

                        @foreach ($order->items as $item)
                            <div>
                                @if ($loop->index !== 0)
                                    <hr>
                                @endif
                                <a href="/item/{{ $item->category }}/{{ $item->slug}}"
                                    title="{{ $item->title }}"
                                    class="d-block"
                                >
                                    <i class="fas fa-angle-right"></i> 
                                    {{ $item->title }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <h5 class="pb-4 text-center">
                    @lang('dashboard.no_orders')
                </h5>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <section class="text-center pb-4">
        <div class="mx-auto d-inline-block">{{ $orders->links() }}</div>
    </section>
</div>

@endsection
