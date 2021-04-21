@extends('layouts.app')

@section('title', trans('items.add_item'))

@section('head')
    <script src="{{ url()->to('/js/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('content')

<div class="container pb-4 col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
    <h5 class="text-center pt-4">
        @lang('items.add_item')
    </h5>

    <div class="row">
        <form action="{{ action('ItemController@store') }}"
            method="post"
            enctype="multipart/form-data"
            class="col-md-6 col-lg-8"
        >
            @csrf
            <div class="row">
                <div class="form-group col-12 col-sm-6">
                    <label>@lang('items.name')</label>

                    <input type="text"
                        value="{{ old('title') }}"
                        name="title"
                        placeholder="@lang('items.name')"
                        class="form-control"
                    >
                </div>
                <div class="form-group col-12 col-sm-6">
                    <label>@lang('items.select_price')</label>
                    <input type="text"
                        value="{{ old('price', '0') }}"
                        name="price"
                        placeholder="@lang('items.price')"
                        class="form-control"
                    >
                </div>
            </div>

            <div class="form-group">
                <label>@lang('items.description')</label>
                <textarea name="content"
                    placeholder="@lang('items.description')"
                    class="form-control"
                    style="min-height: 200px"
                >
                    {{ old('content') }}
                </textarea>
            </div>

            <div class="row">
                <div class="form-group col-sm-2">
                    <label>@lang('items.stock')</label>

                    <input type="number"
                        name="stock"
                        value="{{ old('price', '1') }}"
                        min="0"
                        max="99"
                        class="form-control"
                    >
                </div>
                <div class="form-group col-sm-5">
                    <label>@lang('items.category')</label>

                    <select name="category" class="form-control">
                        @if ($admin_options['women_category'])
                            <option value="women">@lang('items.women_items')</option>
                        @endif
                        @if ($admin_options['men_category'])
                            <option value="men">@lang('items.men_items')</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-5">
                    <label>@lang('items.type')</label>
                    <select name="type" class="form-control">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="custom-file">
                <input type="file" 
                    name="photos[]"
                    class="form-control-file"
                    id="multiple-src-image" 
                    multiple
                >
                <label class="custom-file-label" for="multiple-src-image">
                    @lang('forms.choose_file')...
                </label>
            </div>
            
            <button type="submit" class="btn btn-success btn-block mt-3">
                @lang('items.add_item')
            </button>
            <a href="/items"
                title="@lang('messages.back')"
                class="btn btn-primary btn-block mt-2"
            >
                @lang('messages.back')
            </a>
        </form>

        <div class="col-md-6 col-lg-4 mt-3">
            <img src="{{ asset('/storage/img/small/clothes/default.jpg') }}"
                alt="default"
                class="rounded mx-auto d-block"
                id="target-image1"
                style="width:225px; height:338px; object-fit:cover"
            >
            <div class="row mt-2">
                @for ($i = 2; $i <= 5; $i++)
                    <div class="col-6 mt-2">
                        <img src="{{ asset('/storage/img/small/clothes/default.jpg') }}"
                            alt="default"
                            class="rounded mx-auto d-block"
                            id="target-image{{ $i }}"
                            style="width:113; height:164px;"
                        >
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var editor_config = {
        path_absolute: "{{ URL::to('/') }}/",
        selector: "textarea",
        language: 'ru',
        plugins: [
            "autolink lists link preview wordcount fullscreen paste",
        ],
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
        relative_urls: false
    }
    tinymce.init(editor_config)
</script>
@endsection