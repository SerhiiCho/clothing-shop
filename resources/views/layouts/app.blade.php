<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
    @yield('head')
</head>
<body>
    <main id="app">
        @include('includes.user-sidebar')
        @include('includes.nav')
        @include('includes.gsm')
        @include('includes.messages')
        @yield('content')
        @include('includes.footer')
    </main>
    @include('includes.script')
    @yield('script')
</body>
</html>