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
                    <div class="card p-0">
                        <img class="card-img-top"
                            src="{{ asset("storage/img/big/slider/{$slide->image}") }}"
                            alt="@lang('slider.image')"
                            title="@lang('slider.image')"
                        >
                        <div class="card-body row py-2">
                            @admin
                                {{-- Edit button --}}
                                <a href="slider/{{ $slide->id }}/edit" 
                                    class="btn btn-primary col-6 px-2" 
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
                                        class="btn btn-success btn-block confirm" 
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
    @endif

    {{-- Add slide btn --}}
    <div class="text-center py-5">
        <a href="/admin/slider/create" title="@lang('slider.add_slide')" class="btn btn-success">
            @lang('slider.add_slide')
        </a>
    </div>
</div>

@endsection