<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Idea Furniture</title>
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Hammersmith One">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    @yield('head')
</head>

<style>
    #app{
    display: flex;
    flex-direction: column;
    height: 100vh;
    }

    main{
        flex: 1 0 auto;
    }

    footer{
        background-color: #ebebeb;
        flex-shrink: 0;
    }

    .icon{
        line-height: inherit !important;
        font-size: large;
        color: #7F7F85;
    }

    .icon{
        padding: 0.5rem;
    }

    .searchbox{
        border: 1px solid rgba(0,0,0,.1);
        border-radius: 30px;  
    }

    .searchbox > input:focus, input{
        outline: none;
        background-color: transparent;
    }

    .searchbox > button{
        border: none;
        background-color: transparent;
    }

    form{
        margin-block-end: 0 !important;
    }
</style>

@yield('style')

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Hammersmith One'; color: #F28000; font-size: xx-large">
                    IDEA FURNITURE
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="icon navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <form method="get" action="" class="form-inline searchbox">
                            @csrf
                            <input type="text" class="border-0 pl-3" placeholder="Search...">
                            <button type="submit" class="pr-2">
                                <span class="icon fas fa-search"></span>
                            </button>
                        </form>

                        <a href="">
                            <span class="icon fas fa-shopping-cart pr-2 pl-3"></span>
                        </a>

                        <!-- Authentication Links -->
                        @guest
                            <!--
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            -->

                            <a href="{{ route('login') }}">
                                <span class="icon far fa-user px-2"></span>
                            </a>
                            
                        @else
                            @if(Auth::user()->role == 'admin')
                            <a href="/product/create" class="nav-link">Add Product</a>
                            <a href="/productType/create" class="nav-link">Add Product Type</a>
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role !== 'admin')
                                        <a href="/edit_Profile" class="dropdown-item">Edit Profile</a>
                                        <a href="/cart/{{Auth::user()->id}}" class="dropdown-item">Shopping Cart</a>
                                        <a href="/history" class="dropdown-item">Transaction History</a>

                                        <hr class="dropdown-divide">
                                    @endif
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if(Session::has('message'))
                <div class="alert alert-success alert-block" role="alert">
                    <button class="close" data-dismiss="alert">x</button>
                    {!! Session::pull('message') !!}
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="text-center">
            <div class="text-center p-3">
                © IDEA FURNITURE 2018-2021
            </div>
        </footer>
    </div>
</body>
</html>
