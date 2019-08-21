@extends('layouts.app')

@section('title', trans('table.table'))

@section('content')

<div class="container">
    @if ($items->count() > 0)
        <section class="text-center pt-3">
            <div class="mx-auto d-inline-block">
                {{ $items->appends(request()->input())->links() }}
            </div>
        </section>

        {{-- Table --}}
        <div class="table-responsive-md">
            <table class="table table-striped table-hover compact-table">
                <thead class="thead-light">
                    <tr>
                        {{-- ID --}}
                        <th scope="col" title="@lang('table.number')">
                            <a href="/admin/table?order=id">
                                <span class="{{ $order == 'id' ? 'text-success' : 'grey' }}">#</span>
                            </a>
                        </th>

                        {{-- Title --}}
                        <th scope="col">
                            <a href="/admin/table?order=title">
                                <span class="{{ $order == 'title' ? 'text-success' : 'grey' }}">
                                    @lang('items.name')
                                </span>
                            </a>
                        </th>

                        {{-- Unique Views --}}
                        <th scope="col" title="@lang('table.views')">
                            <a href="/admin/table?order=views_count">
                                <i class="fas fa-eye {{ $order == 'views_count' ? 'text-success' : 'grey' }}"></i>
                            </a>
                        </th>

                        {{-- Stock --}}
                        <th scope="col" title="@lang('table.items_in_stock')">
                            <a href="/admin/table?order=stock">
                                <i class="fas fa-boxes {{ $order == 'stock' ? 'text-success' : 'grey' }}"></i>
                            </a>
                        </th>

                        {{-- Price --}}
                        <th scope="col">
                            <a href="/admin/table?order=price">
                                <span class="{{ $order == 'price' ? 'text-success' : 'grey' }}">
                                    @lang('items.price')
                                </span>
                            </a>
                        </th>

                        {{-- Type --}}
                        <th scope="col">
                            <span class="grey">@lang('items.type')</span>
                        </th>

                        {{-- Category --}}
                        @if ($admin_options['men_category'] && $admin_options['women_category'])
                            <th scope="col">
                                <a href="/admin/table?order=category">
                                    <span class="{{ $order == 'category' ? 'text-success' : 'grey' }}">
                                        @lang('items.category')
                                    </span>
                                </a>
                            </th>
                        @endif

                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            {{-- Number ID --}}
                            <th scope="row">
                                <a href="/item/{{ $item->category }}/{{ $item->slug }}" class="text-success">
                                    {{ $item->id }}
                                </a>
                            </th>

                            {{-- Item Title --}}
                            <td title="{{ $item->title }}">
                                <a href="/item/{{ $item->category }}/{{ $item->slug }}" class="grey">
                                    {{ string_limit($item->title, 30) }}
                                </a>
                            </td>

                            {{-- Views --}}
                            <td>{{ $item->views()->count() }}</td>

                            <td>{{ $item->stock }}</td>
                            <td>{{ nice_money_format($item->price) }}</td>

                            {{-- Type --}}
                            <td title="{{ $item->type->name }}">{{ string_limit($item->type->name, 14) }}</td>

                            {{-- Category --}}
                            @if ($admin_options['men_category'] && $admin_options['women_category'])
                                <td>
                                    {{ $item->category == 'men' ? trans('navigation.men') : trans('navigation.women') }}
                                </td>
                            @endif

                            {{-- Edit button --}}
                            <td>
                                <a href="/items/{{ $item->slug }}/edit"
                                    title="@lang('items.change')"
                                    class="btn btn-sm btn-primary"
                                >
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </td>

                            {{-- Delete button --}}
                            <td>
                                <div class="btn btn-success btn-sm">
                                    <delete-item-btn
                                        title="@lang('cart.delete')"
                                        slug="{{ $item->slug }}"
                                        redirect="/admin/table"
                                    ></delete-item-btn>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center py-4">@lang('table.no_data')</p>
    @endif
</div>

@endsection