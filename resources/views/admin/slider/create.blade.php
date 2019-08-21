@extends('layouts.app')

@section('title', trans('slider.add_slide'))

@section('content')

<div class="container pb-5">
    <h4 class="display-4 text-center p-3">@lang('slider.add_slide')</h4>
    <div>
        <img src="{{ asset('/storage/img/big/slider/default.jpg') }}" 
            class="rounded mx-auto d-block slider-preview-img" 
            id="target-image"
        />
    </div>
    <div class="col-md-8 offset-md-2">

        <form action="{{ action('Admin\SliderController@store') }}"
            method="post" 
            enctype="multipart/form-data" 
            class="row"
        >
            @csrf

            <div class="form-group mt-3 col-12 col-md-4">
                <input type="number"
                    class="form-control"
                    name="order"
                    placeholder="@lang('slider.choose_order_number')"
                >
            </div>

            <div class="custom-file mt-3 col-12 col-md-8">
                <input type="file"
                       name="image"
                       class="custom-file-input"
                       id="src-image"
                >
                <label class="custom-file-label" for="src-image">
                    @lang('forms.choose_file')...
                </label>
            </div>

            <div class="col-12 mt-3 text-center">
                {{-- Add slide button --}}
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fas fa-plus mr-2"></i>
                    @lang('slider.add_slide')
                </button>

                {{-- Back button --}}
                <a href="/admin/slider" class="btn btn-block mt-2">
                    <i class="fas fa-chevron-left mr-2"></i>
                    @lang('messages.back')
                </a>
            </div>
        </form>
    </div>
</div>

@endsection