@extends('layouts.app')

@section('title', trans('slider.slider'))

@section('content')

<div class="container">
    @if ($slider->count() > 0)
        <h3 class="display-4 text-center pt-3 pb-3">
            @lang('slider.slider'): 
            {{ $slider->count() }}
        </h3>

        <div class="row">
            @foreach ($slider->reverse() as $slide)
                <div class="col-md-6 col-xl-4">
                    <div class="card p-0 position-relative">
                        <img class="card-img-top"
                            src="{{ asset("storage/img/big/slider/{$slide->image}") }}"
                            alt="@lang('slider.image')"
                            title="@lang('slider.image')"
                        >

                            {{-- Order badges --}}
                            <div class="position-absolute m-1">
                                <h5>
                                    @if ($slide->order)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i>
                                            @lang('slider.choose_order_number'): {{ $slide->order }}
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times"></i>
                                            @lang('slider.no_order')
                                        </span>
                                    @endif
                                </h5>
                            </div>

                        <div class="card-body row py-2">
                            @admin
                                {{-- Edit button --}}
                                <a href="slider/{{ $slide->id }}/edit" 
                                    class="btn btn-sm btn-primary col-6 px-2" 
                                    title="@lang('slider.edit')"
                                >
                                    @lang('slider.edit')
                                </a>

                                {{-- Delete button --}}
                                <form action="{{ action('Admin\SliderController@destroy', ['slider' => $slide->id]) }}" 
                                    method="post" 
                                    class="col-6 px-1"
                                >

                                    @csrf @method('delete')

                                    {{-- Delete slide btn --}}
                                    <button type="submit" 
                                        class="btn btn-sm btn-success btn-block confirm" 
                                        title="@lang('slider.delete')"
                                        data-confirm="@lang('slider.are_you_sure')"
                                    >
                                        @lang('slider.delete')
                                    </button>
                                </form>
                            @endadmin
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center pt-5">@lang('slider.no_slides')</p>
    @endif

    {{-- Add slide btn --}}
    <div class="text-center py-5">
        <a href="/admin/slider/create" title="@lang('slider.add_slide')" class="btn btn-success">
            @lang('slider.add_slide')
        </a>
    </div>
</div>

@endsection