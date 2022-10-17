<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Remote Homework') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap implementation -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
   <link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">
    {{-- @todo: should be loaded last in body, but that breaks `onscroll` attribute sometimes --}}
    {{-- <script type="text/javascript" src="{{ mix('js/index.js') }}"></script> --}}

    @routes

    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
</head>
<body onscroll="scrollFunction()">
       <script src="/fabric.js"></script>
    @inertia

</body>
</html>
