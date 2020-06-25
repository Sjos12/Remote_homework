<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Remote Homework') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap implementation -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- @todo: should be loaded last in body, but that breaks `onscroll` attribute sometimes --}}
    <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
</head>
<body onscroll="scrollFunction()">
    <div id="app" >
        <nav id="navbar" class="navbar navbar-expand-md bg-white shadow-sm sticky-top darkmodetoggle">
            <!-- Use container-fluid to arrange navbar items from edge to edge -->
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img id="logo" src="{{ asset('images/remote_homework_logo.png') }}" alt="Logo" style="width:105px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link hvr-underline-from-center" href="{{ route('home') }}#content1" id="nav-link">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hvr-underline-from-center" href="{{ route('home') }}#content2" id="nav-link">{{ __('Info') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hvr-underline-from-center" href="{{ route('home') }}#content3" id="nav-link">{{ __('Contact') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" id="nav-link">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" id="nav-link">{{ __('Register') }}</a>
                                </li>
                            @endif
                        <!-- only gets called when user is logged in -->
                        @else
                            <li class="nav-item">
                                <!-- put the route for the 'public' questions here-->
                                <a href="{{ route('feed.list') }}" class="nav-link" id="nav-link">Question Feed</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-link" v-pre>
                                   Hello, {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdownmenunav">

                                    <a class="dropdown-item" href="{{ route('questions.list') }}">{{ __('My questions') }}</a>
                                    <!--<a class="dropdown-item" href="{{ route('pages.dashboard') }}">{{ __('Dashboard') }}</a>-->
                                    <a class="dropdown-item" href="{{ route('questions.create') }}">{{ __('Ask a question') }}</a>

                                    <a class="dropdown-item" href="{{ route('marketplace.home')}}">{{ __('Marketplace') }}</a>

                                    <hr class="dropdownmenu-hr">

                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    >
                                        {{ __('Logout') }}
                                    </a>



                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <!-- main content of the page -->
            @yield('content')
        </main>
        <!-- the footer of the page -->

    </div>

    @include('pages.footer')

    <script src="{{ asset('fabric.js') }}"></script>
    <script src="{{ asset('tools.js') }}"></script>
</body>
</html>
