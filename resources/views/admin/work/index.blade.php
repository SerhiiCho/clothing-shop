@extends('layouts.app')

@section('title', trans('user-sidebar.work'))

@section('content')

<div class="container">
    <h4 class="text-center py-3">@lang('dashboard.your_orders'):</h4>

    <div class="row pb-5">
        @forelse ($messages as $order)
            <div class="col-sm-6 col-xl-4 mb-4">
                <div class="card">
                    <form action="{{ action('Admin\MessageController@destroy', ['id' => $order->id]) }}"
                        method="post"
                    >
                        @csrf @method('delete')
                        <button type="submit"
                            class="confirm btn btn-success btn-sm btn-block"
                            data-confirm="@lang('dashboard.delete_this_order')"
                        >
                            <i class="fas fa-ban" aria-hidden="true"></i> 
                            @lang('messages.close_order')
                        </button>
                    </form>
                    <div class="card-body">
                        <h5 class="card-title">
                            @lang('items.clients_order') 
                            # {{ $order->id }}
                        </h5>
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
                            <h5>@lang('dashboard.products'):</h5>
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
        <div class="mx-auto d-inline-block">{{ $messages->links() }}</div>
    </section>
</div>

@endsection
