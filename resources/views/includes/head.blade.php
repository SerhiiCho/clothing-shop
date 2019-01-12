<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
<title>@yield('title') | {{ config('app.name') }}</title>

<link rel="stylesheet" href="{{ asset('css/app.css?').config('app.version') }}">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">