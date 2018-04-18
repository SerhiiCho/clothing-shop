@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-xs-12 heading center">@lang('forms.login_title')</div>

	<form method="POST" action="{{ route('login') }}" class="form">
		@csrf

		<label for="email">@lang('forms.input_email_address')</label>
		<input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="@lang('forms.input_email_address')" required autofocus>

		<label for="password">@lang('forms.input_password')</label>
		<input id="password" type="password" name="password" placeholder="@lang('forms.input_password')" required>

		<div class="checkbox block">
			<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
			<span>@lang('forms.input_remember_me')</span>
		</div>

		<button type="submit" class="btn block">@lang('forms.login_title')</button>

		{{-- <a href="{{ route('password.request') }}">
			@lang('forms.forgot_password')
		</a> --}}
	</form>
</div>

@endsection
