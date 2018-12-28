<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>@include('includes.head')</head>
<body>
    <main id="app">
        @yield('content')
    </main>
    @include('includes.script')
</body>
</html>