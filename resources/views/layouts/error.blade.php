<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>@include('includes.head')</head>
<body>
    <main id="app">
        @yield('content')
    </main>
    <script src="{{ asset('js/app.js?').config('app.version') }}"></script>
</body>
</html>