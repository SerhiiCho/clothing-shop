@extends('layouts.app')

@section('title', trans('cards.change_card'))

@section('content')

<div class="container pb-5">
    <h4 class="display-4 text-center p-3">@lang('cards.change_card')</h4>
    <div>
        <img src="{{ asset("/storage/img/big/cards/{$card->image}") }}"
            alt="{{ $card->type->type }}"
            class="rounded mx-auto d-block"
            id="target-image"
            style="width:225px; height:338px; object-fit:cover"
        >
    </div>
    <div class="col-md-8 offset-md-2">

        <form action="{{ action('Admin\CardController@update', ['card' => $card->id]) }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            @method('put')
            <div class="custom-file mt-3">
                <input type="file" name="image"
                    class="custom-file-input"
                    id="src-image"
                >
                <label class="custom-file-label" for="src-image">
                    @lang('forms.choose_file')...
                </label>
            </div>

            <div class="row mt-2">
                <div class="form-group col-sm-6">
                    <label class="mb-1">@lang('forms.choose_category')</label>
                    <select name="category" class="form-control">
                        <option value="{{ $card->category }}">{{ $category }}</option>
                        <option>------------------------</option>

                        @if ($admin_options['women_category'])
                            <option value="women">@lang('items.women_items')</option>
                        @endif

                        @if ($admin_options['men_category'])
                            <option value="men">@lang('items.men_items')</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="mb-1">@lang('forms.choose_type')</label>
                    <select name="type" class="form-control" id="type">

                        <option value="{{ $card->type_id }}">
                            {{ $card->type->name }}
                        </option>
                        <option value="none">
                            -------------------------
                        </option>

                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Save button --}}
            <button type="submit"
                class="btn btn-success btn-block mt-3"
                title="@lang('cards.save_changes')"
            >
                @lang('cards.save_changes')
            </button>
        </form>

        {{-- Delete button --}}
        <form action="{{ action('Admin\CardController@destroy', ['card' => $card->id]) }}"
            method="post"
            class="my-2"
        >

            @csrf @method('delete')

            <button type="submit"
                class="btn btn-primary btn-block confirm"
                title="@lang('cards.delete_card')"
                data-confirm="@lang('cards.are_you_sure_you_want_delete')"
            >
                @lang('cards.delete_card')
            </button>
        </form>

        {{-- Back button --}}
        <a href="/admin/cards"
            title="@lang('messages.back')"
            class="btn btn-primary btn-block mt-2"
        >
            @lang('messages.back')
        </a>
    </div>
</div>

@endsection