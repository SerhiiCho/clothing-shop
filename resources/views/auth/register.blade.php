@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-xs-12 heading center">@lang('forms.register_title')</div>

	<form method="POST" action="{{ route('register') }}" class="form">
		@csrf

		<label for="name">@lang('forms.input_name')</label>
		<input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="@lang('forms.input_name')" required autofocus>

		<label for="email">@lang('forms.input_email_address')</label>
		<input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="@lang('forms.input_email_address')" required>

		<label for="password">@lang('forms.input_password')</label>
		<input id="password" type="password" name="password" placeholder="@lang('forms.input_password')" required>

		<label for="password-confirm">@lang('forms.confirm_password')</label>
		<input id="password-confirm" type="password" name="password_confirmation" placeholder="@lang('forms.confirm_password')" required>

		<div class="spacer"></div>

		<button type="submit" class="btn block">@lang('forms.register_title')</button>
	</form>
</div>

@endsection
