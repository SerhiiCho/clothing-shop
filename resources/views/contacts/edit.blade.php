@extends('layouts.app')

@section('title', trans('contacts.change_contact'))

@section('content')

<div class="container pb-5">
    <h4 class="display-4 text-center p-3">@lang('contacts.change_contact')</h4>
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <form action="{{ action('GsmController@update', ['contact' => $contact->id]) }}"
                method="POST"
            >
                @csrf @method('put')

                <div class="form-group">
                    <label for="phone">@lang('contacts.write_phone_number')</label>
                    <input type="text" 
                        value="{{ $contact->phone }}" 
                        name="phone"
                        class="form-control" 
                        id="phone" 
                        placeholder="(095) 777-77-77" 
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="icon">@lang('contacts.choose_icon')</label>
                    <select class="form-control" id="icon" name="icon">
                        @isset($contact->icon)
                            <option value="{{ $contact->icon_id }}">
                                {{ $contact->icon->name }}
                            </option>
                            <option value="">---------------------------</option>
                        @endisset

                        @foreach ($icons as $icon)
                            <option value="{{ $icon->id }}">{{ $icon->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Save btn --}}
                <button type="submit"
                    class="btn btn-success btn-block" 
                    title="@lang('contacts.change_contact')"
                >
                    @lang('contacts.save')
                </button>
            </form>
            <form action="{{ action('GsmController@destroy', ['contact' => $contact->id]) }}"
                method="post" 
                class="mt-2" 
                onsubmit='return confirm("@lang('contacts.confirm_delete')")'
            >
                @csrf @method('delete')

                {{-- Delete btn --}}
                <button class="btn btn-primary btn-block" title="@lang('contacts.delete')">
                    @lang('contacts.delete')
                </button>
            </form>

            {{-- Back btn --}}
            <a href="/contacts/create" 
                title="@lang('messages.back')"
                class="btn btn-primary btn-block mt-2"
            >
                @lang('messages.back')
            </a>
        </div>
    </div>
</div>

@endsection