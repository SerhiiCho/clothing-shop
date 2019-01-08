@extends('layouts.app')

@section('title', trans('user-sidebar.orders'))

@section('content')

<div class="container pt-2">
    <div class="text-center" v-if="false">
        <div class="loader mt-1"></div>
    </div>
    <tabs>
        @for ($i = 1; $i <= 3; $i++)
            <tab 
                @if ($i == 1)
                    hash="!tab-1"
                    name="@lang('messages.opened_orders') 
                    <b>{{ $open_orders->count() }}</b>"
                    :selected="true"
                @elseif ($i == 2)
                    hash="!tab-2"
                    name="@lang('messages.taken_orders') 
                    <b>{{ $taken_orders->count() }}</b>"
                @elseif ($i == 3)
                    hash="!tab-3"
                    name="@lang('messages.closed_orders') 
                    <b>{{ $closed_orders->count() }}</b>"
                @endif
            >
                @include('admin.orders.partials.tab-content')
            </tab>
        @endfor
    </tabs>

    {{-- Pagination --}}
    <section class="text-center pb-4">
        <div class="mx-auto d-inline-block">
            @if ($i == 1)
                {{ $open_orders->links() }}
            @elseif($i == 2)
                {{ $taken_orders->links() }}
            @elseif($i == 3)
                {{ $closed_orders->links() }}
            @endif
        </div>
    </section>
</div>

@endsection
