@extends('layouts.app')

@section('title', trans('contacts.change_contact'))

@section('content')

<div class="container pb-5">
    <h4 class="display-4 text-center p-3">
        @lang('contacts.change_contact')
    </h4>

    <div class="row">
        <div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <form action="{{ action('Admin\ContactController@update', ['contact' => $contact->id]) }}"
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
                <button type="submit" class="btn btn-success btn-block" title="@lang('contacts.change_contact')">
                    <i class="fas fa-save float-left mt-1"></i> @lang('contacts.save')
                </button>
            </form>

            <form action="{{ action('Admin\ContactController@destroy', ['contact' => $contact->id]) }}"
                method="post" 
                class="mt-2" 
            >
                @csrf @method('delete')

                {{-- Delete btn --}}
                <button class="btn btn-success btn-block confirm" data-confirm="@lang('contacts.confirm_delete')">
                    <i class="fas fa-trash float-left mt-1"></i>
                    @lang('logs.delete')
                </button>
            </form>

            {{-- Back btn --}}
            <a href="/admin/contacts" class="btn btn-success btn-block mt-2">
                <i class="fas fa-chevron-left float-left mt-1"></i> @lang('messages.back')
            </a>
        </div>
    </div>
</div>

@endsection