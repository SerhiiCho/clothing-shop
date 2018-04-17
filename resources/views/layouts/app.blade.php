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
</head>
<body>
	<div class="hamburger-up" id="hamburger-container">
		<div id="hamburger">
			<i>
				<span class="lines line1"></span>
				<span class="lines line2"></span>
				<span class="lines line3"></span>
			</i>
		</div>
		<a href="/" title="Главная" id="logo-clothing" style="color:#000;">
			Clothing Shop
		</a>
	</div>
		
	<main id="app">
		@include('includes.nav')

		@include('includes.gsm')
		
		@yield('content')
		
		@include('includes.footer')
	</main>

	<script src="{{ asset('js/jquery.js') }}" defer></script>
	<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>