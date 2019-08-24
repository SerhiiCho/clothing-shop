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
        <a href="javascript:;" class="show-user-sidebar-btn"><i class="fas fa-arrow-alt-circle-right"></i></a>
        @include('includes.gsm')
        @include('includes.messages')
        <div class="min-height">
            @yield('content')
        </div>
        @include('includes.footer')
    </main>
    <script src="{{ asset('js/app.js?').config('app.version') }}"></script>
    @yield('script')
</body>
</html>