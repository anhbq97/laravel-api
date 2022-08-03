<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="{{ asset('/themes/vendor/fontawesome-free-6.0.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    {{--    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />--}}
    {{--    <link href="{{ asset('css/blog_home.css') }}" rel="stylesheet" />--}}
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('styles')
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
<div class="app flex-row align-items-center">
    <div class="container">
        @yield("content")
    </div>
</div>

<script src="{{ asset('themes/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('themes/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('themes/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('themes/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
@yield('scripts')
</body>

</html>
