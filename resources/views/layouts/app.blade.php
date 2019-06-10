<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Pik Pinchart - Womanswear Designer') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        /* .navbar, .navbar-header, .navbar-default{
            background-color: transparent;
            border-color: transparent;
        }*/

        .nav-item, .dropdown-toggle, .dropdown{
            color: black;
            font-weight: bold;
            font-size: 15px;
        }
        .nav-item:hover, .dropdown:hover{
            background-color: rgba(255,55,78,0.5)
        }

        .navbar-collapse{
            background: white;
        }
        .navbar{
            position: fixed;
            top:0;
            width: 100%;
        }
        footer {
            background: url('images/background.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: 100;
            -webkit-animation-name: backgrAnim;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: ease;
            -webkit-animation-iteration-count: 1;
            text-align: center;
            font-family: arial;
            margin-bottom: 0;
            height: 20vh;
            position: relative;
            bottom: 0;
        }
        .footerLinks {
        text-align: center;
        }
        .footerLinks ul {
            padding: 0;
            list-style-type: none;
            margin: 0;
        }
        .footerLinks li {
            display: inline;
        }
        .footerLinks a {
            color: black;
            font-weight: bold;
            text-decoration: none;
            font-size: 13px;
        }
        .copyright {
            text-align: center;
        }

        .copyright p {
            margin: 0;
            color: #b3b3b3;
            font-size: 11px;
        }
        .jumbotron{
            background: url('images/background.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: 100;
            -webkit-animation-name: backgrAnim;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: ease;
            -webkit-animation-iteration-count: 1;
        }

        body{
            background: url('images/background.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: 100;
            -webkit-animation-name: backgrAnim;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: ease;
            -webkit-animation-iteration-count: 1;
        }
    </style>
    @yield('stylesheet');
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ url('images/logo2.png')}}" alt="logo" style="position: relative;  height: 50px;">
                        {{-- {{ config('app.name', "Pik Pinchart &#8212; Womanswear Designer") }} --}}
                    </a>

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    {{-- Left Side of Navbar --}}
                    <ul class="nav navbar-nav navbar-left">
                        <li class="nav-item"><a class="nav-link" href="{{ url("in-progress") }}">In progress</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url("contact") }}">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url("about-me") }}">About me</a></li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Womenswear</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url("womenswear/berlin's wall") }}">Berlin's wall</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Shoes</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url("shoes/vulgar") }}">Vulgar</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Accessories</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ url("accessories/accessories project") }}">Accessories project</a></li>
                                </ul>
                            </li>
                            
                        <!-- Authentication Links -->
                        @guest
                        @else
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li class="nav-item{{ route('image.create') }}"><a class="nav-link" href="{{ route('image.create') }}">@lang('Ajouter une image')</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="fixedNavbar" style="height:50px;"></div>

        @yield('content')

        <footer>
            <div class="footerLinks">
                <ul>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Legal</a></li>
                    <li><a href="#">Site Map</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="copyright">
                <p>Copyright 2016</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
