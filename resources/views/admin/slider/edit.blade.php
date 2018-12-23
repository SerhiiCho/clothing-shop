@extends('layouts.app')

@section('title', trans('slider.edit_slide'))

@section('content')

<div class="container pb-5">
    <h4 class="display-4 text-center p-3">@lang('slider.edit_slide')</h4>
    <div>
        <img src="{{ asset("/storage/img/big/slider/{$slider->image}") }}" 
            class="rounded mx-auto d-block" 
            id="target-image"
        />
    </div>
    <div class="col-md-8 offset-md-2">

        <form action="{{ action('Admin\SliderController@update', ['slider' => $slider->id]) }}" 
            method="post"
            enctype="multipart/form-data" 
            class="row"
        >

            @csrf @method('put')

            <div class="custom-file mt-3 col-12 col-md-6">
                <input type="file" name="image" class="custom-file-input" id="src-image">
                <label class="custom-file-label" for="src-image">
                    @lang('forms.choose_file')...
                </label>
            </div>
            <div class="form-group mt-3 col-12 col-md-6">
                <input type="number" 
                    value="{{ $slider->order }}" 
                    class="form-control" 
                    name="order" 
                    placeholder="@lang('slider.choose_order_number')"
                >
            </div>

            {{-- Save button --}}
            <button type="submit" 
                class="btn btn-success btn-block mt-3" 
                title="@lang('slider.save_changes')"
            >
                @lang('slider.save_changes')
            </button>
        </form>

        {{-- Delete button --}}
        <form action="{{ action('Admin\SliderController@destroy', ['slider' => $slider->id]) }}" 
            method="post" 
            onsubmit='return confirm("@lang('slider.are_you_sure')")' 
            class="my-2 row"
        >

            @csrf @method('delete')

            {{-- Delete button --}}
            <button type="submit" class="btn btn-primary btn-block" title="@lang('slider.delete')">
                @lang('slider.delete')
            </button>

            {{-- Back button --}}
            <a href="/admin/slider" title="@lang('messages.back')" class="btn btn-primary btn-block mt-2">
                @lang('messages.back')
            </a>
        </form>
    </div>
</div>

@endsection