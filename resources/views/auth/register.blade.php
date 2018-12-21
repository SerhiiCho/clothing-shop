@extends('layouts.app')

@section('title', trans('forms.register_title'))

@section('content')

<div class="container">
    <h3 class="text-center pt-4">@lang('forms.register_title')</h3>

    <div class="col-12 offset-md-3 col-md-6 pb-5">
        <form method="POST" action="{{ route('register') }}" class="form">
            @csrf

            <div class="form-group">
                <label for="name">@lang('forms.input_name')</label>
                <input id="name"
                    class="form-control"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="@lang('forms.input_name')"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="email">@lang('forms.input_email_address')</label>
                <input id="email"
                    class="form-control" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="@lang('forms.input_email_address')" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">@lang('forms.input_password')</label>
                <input id="password" 
                    class="form-control" 
                    type="password" 
                    name="password" 
                    placeholder="@lang('forms.input_password')" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="password-confirm">@lang('forms.confirm_password')</label>
                <input id="password-confirm" 
                    class="form-control" 
                    type="password" 
                    name="password_confirmation" 
                    placeholder="@lang('forms.confirm_password')" 
                    required
                >
            </div>

            <button type="submit" class="btn btn-success">
                @lang('forms.register_title')
            </button>
        </form>
    </div>
</div>

@endsection
