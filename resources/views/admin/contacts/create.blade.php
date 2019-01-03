@extends('layouts.app')

@section('title', trans('user-sidebar.contacts'))

@section('content')

<div class="container pb-5">
    <h4 class="display-4 text-center p-3">@lang('contacts.add_contact')</h4>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <form action="{{ action('Admin\ContactController@store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="phone">@lang('contacts.write_phone_number')</label>

                    <input type="text" 
                        name="phone" 
                        class="form-control" 
                        id="phone" 
                        placeholder="(095) 777-77-77" 
                        required
                    >
                </div>

                @isset($icons)
                    <div class="form-group">
                        <label for="icon">@lang('contacts.choose_icon')</label>
                        <select class="form-control" id="icon" name="icon">
                            <option value="">@lang('contacts.without_icon')</option>

                            @foreach ($icons as $icon)
                                <option value="{{ $icon->id }}">{{ $icon->name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endisset

                <div class="text-center">
                    {{-- Add contact btn --}}
                    <button type="submit" 
                        class="btn btn-success"
                        title="@lang('contacts.add_contact')"
                    >
                        @lang('contacts.add_contact')
                    </button>

                    {{-- Back btn --}}
                    <a href="/admin/contacts" class="btn btn-primary" title="@lang('messages.back')">
                        &laquo; @lang('messages.back')
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection