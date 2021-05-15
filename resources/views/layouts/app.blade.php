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

    {{-- @todo: should be loaded last in body, but that breaks `onscroll` attribute sometimes --}}
    <script type="text/javascript" src="{{ mix('js/index.js') }}"></script>
</head>
<body onscroll="scrollFunction()">
    <div id="app" >
        <nav id="navbar" class="navbar navbar-expand-md bg-white shadow-sm sticky-top darkmodetoggle">
            <!-- Use container-fluid to arrange navbar items from edge to edge -->
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img id="logo" src="{{ asset('images/remote_homework_logo.png') }}" alt="Logo" style="width:130px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="19" viewBox="0 0 27 19">
                        <g id="Group_13" data-name="Group 13" transform="translate(-311 -21)">
                            <rect id="Rectangle_41" data-name="Rectangle 41" width="27" height="2" rx="1" transform="translate(311 21)" fill="#5bb9fd"/>
                            <rect id="Rectangle_42" data-name="Rectangle 42" width="27" height="2" rx="1" transform="translate(311 29)" fill="#5bb9fd"/>
                            <rect id="Rectangle_43" data-name="Rectangle 43" width="27" height="2" rx="1" transform="translate(311 37)" fill="#5bb9fd"/>
                        </g>
                    </svg>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!--<ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link hvr-underline-from-center" href="{{ route('home') }}#content1" id="nav-link">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hvr-underline-from-center" href="{{ route('home') }}#content2" id="nav-link">{{ __('Tutorials') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hvr-underline-from-center" href="{{ route('home') }}#content3" id="nav-link">{{ __('Rules') }}</a>
                        </li>
                    </ul>-->

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
                                <a href="{{ route('feed.list') }}" class="nav-link navlinkfont" id="nav-link">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="nav-item dropdown d-flex">
                                <div class="profilepicture-container profilepicture-container--nav shadow ml-4">
                                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->getFirstMediaUrl('profiles') }}" class="h-100" alt=""> 
                                </div>
                                <a id="navbarDropdown" class="d-flex align-items-center justify-content-center nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="nav-link" v-pre>
                                    
                                    {{ __('Hello, :Name', ['name' => \Illuminate\Support\Facades\Auth::user()->name]) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdownmenunav">

                                    <a class="dropdown-item" href="{{ route('questions.list') }}">{{ __('My questions') }}</a>
                                    <a class="dropdown-item" href="{{ route('questions.create') }}">{{ __('Ask a question') }}</a>

                                    <a class="dropdown-item" href="{{ route('marketplace.home')}}">{{ __('Marketplace') }}</a>

                                    <hr class="dropdownmenu-hr">
                                    <a class="dropdown-item" href="{{ route('account.view') }}">Account</a>
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
    <!-- public scripts -->
    <script src="{{ asset('fabric.js') }}"></script>
    <script src="{{ asset('tools.js') }}"></script>
    <script src="{{ asset('steppedform.js') }}"></script>
    <script src="{{ asset('dropzone.js') }}"></script>
    <!-- Compiled scripts -->
    <script src="{{ asset('/js/imgdrop.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
