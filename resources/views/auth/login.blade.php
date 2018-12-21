@extends('layouts.app')

@section('title', trans('forms.login_title'))

@section('content')

<div class="container">
    <h3 class="text-center pt-4">@lang('forms.login_title')</h3>
    
    <div class="col-12 offset-md-3 col-md-6 pb-5">
        <form method="POST" action="{{ route('login') }}" class="form">
            @csrf
            
            <div class="form-group">
                <label for="email">@lang('forms.input_email_address')</label>
                <input id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}" 
                    placeholder="@lang('forms.input_email_address')"
                    class="form-control"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">@lang('forms.input_password')</label>
                <input id="password"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="@lang('forms.input_password')"
                    required
                >
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="form-check-input" {{ old('remember') ? 'checked' : '' }}
                    >
                    <label class="form-check-label" for="form-check-input">
                        @lang('forms.input_remember_me')
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                @lang('forms.login_title')
            </button>

            {{-- <a href="{{ route('password.request') }}">
                @lang('forms.forgot_password')
            </a> --}}
        </form>
    </div>
</div>

@endsection
