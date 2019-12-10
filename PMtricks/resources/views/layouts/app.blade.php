<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SSWLS') }}</title>
    
    
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    {{-- <script src="{{asset('js/main.js')}}"></script>   --}}
    {{-- that fuckin script has alot of bugs  --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- 
        those three link tag cus all the problem
        the bootstrap make the nav bar work out
        and crack every thing else ..
    --> solve this problem later plz !
        --}}

    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <style>
        body, html{     
            /* Prevent selection */
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;  
        }

        .wrapper {
            /* width:100%; */
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }
        .center-me {
            display:flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    
                                    @if(Auth::guard('web')->check())
                                        <a class="dropdown-item" href="{{ route('home') }}">Home</a>
                                        <a class="dropdown-item" href="{{ route('FreeQuiz')}}">Free Quiz</a>
                                        <a class="dropdown-item" href="{{ route('PremiumQuiz-st1')}}">Premium Quiz</a>
                                        <a class="dropdown-item" href="{{ route('scoreHistory')}}">Score History</a>
                                        <a class="dropdown-item" href="{{ route('user.index')}}">Contact Admin</a>                                        
                                    @elseif(Auth::guard('admin')->check())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Home</a>
                                        <a class="dropdown-item" href="{{ route('question.index') }}">Questions</a>
                                        <a class="dropdown-item" href="{{ route('question.create') }}">Add Question</a>
                                        <a class="dropdown-item" href="{{ route('packages.index') }}">Packages</a>
                                        <a class="dropdown-item" href="{{ route('packages.create') }}">Add Package</a>
                                        <a class="dropdown-item" href="{{ route('chapterManager.show') }}">Chapters Manager</a>
                                    @endif


                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
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

        <main class="py-4" id = "foo">
            <div class="container">
                @include('include.msg')
            </div>
            @yield('content')
        </main>
    </div>
    
</body>
</html>
