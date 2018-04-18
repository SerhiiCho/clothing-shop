<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    <title>{{ config('app.name', '') }}</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="shortcut icon" href="{{ asset('storage/img/favicon.png') }}" type="image/x-icon">
</head>
<body>
	<main id="app">
		@include('includes.nav')
		
		@include('includes.gsm')
		
		@include('includes.messages')

		@yield('content')
		
		@include('includes.footer')
	</main>

	<script src="{{ asset('js/jquery.js') }}" defer></script>
	<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>