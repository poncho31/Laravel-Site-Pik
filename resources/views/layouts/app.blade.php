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
        .nav-item:hover, .dropdown li a:hover{
            color: white;
            background-color: rgba(127,0,0,0.6);;
        }

        .navbar-default .navbar-nav > li > a:hover{
            color: white;
            background-color: rgba(127,0,0,0.6);;
        }

        .navbar-collapse{
            background: white;
        }
        .navbar{
            position: fixed;
            top:0;
            width: 100%;
        }
        h3{
            font-family: Montserrat;
        }
        footer {
            background: url('../images/background.jpg');
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
            padding: 3%;
        }
        .footerLinks li:hover a{
            color:white;
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

        body, .jumbotron{
            background: url('../images/background.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: 100;
            -webkit-animation-name: backgrAnim;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: ease;
            -webkit-animation-iteration-count: 1;
            /* padding-top:0px;
            margin-top: 0px; */
        }
        .admin:hover{
            opacity: 0.4;
            filter: alpha(opacity=40);
            cursor: pointer;
        }
    </style>
    @yield('stylesheet');
</head>
<body>

    @auth @php $admin = "admin" @endphp @endauth
    @guest @php $admin = "" @endphp @endguest

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
                    {{-- Left Side of Navbar STATIC MENU--}}
                    <ul class="nav navbar-nav navbar-left">
                        <li class="nav-item"><a class="nav-link" href="{{ url("in-progress") }}">In progress</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url("contact") }}">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url("about-me") }}">About me</a></li>
                    </ul>
                    <!-- Right Side Of Navbar DYNAMIC MENU-->
                    <ul class="nav navbar-nav navbar-right">

                            @foreach($menu as $section => $v)
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">{{ ucfirst(trans($section)) }}</span> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @foreach($v as $project)
                                            <li class="nav-item"><a class="nav-link" href="{{ url("$section/$project") }}">{{ ucfirst(trans($project)) }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            
                        <!-- Authentication Links -->
                        @auth
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li class="nav-item{{ route('image.create') }}"><a class="nav-link" href="{{ route('image.create') }}">@lang('Ajouter des images')</a></li>
                                    <li class="nav-item{{ route('in-progress.create') }}"><a class="nav-link" href="{{ route('in-progress.create') }}">@lang('Ajouter un article')</a></li>
                                    <li class="nav-item{{ route('delete') }}"><a class="nav-link" href="{{ route('delete') }}">@lang('Supprimer')</a></li>
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
                        @endauth
                        
                    </ul>
                </div>
            </div>
        </nav>
        <div class="fixedNavbar" style="height:50px;"></div>
        
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        @yield('content')
        <footer>
            <div class="footerLinks" style="position:relative;bottom:0;">
                <ul>
                    @foreach($menu as $section => $v)
                        @foreach($v as $project)
                            <li class="nav-item"><a class="nav-link" href="{{ url("$section/$project") }}">{{ ucfirst(trans($project)) }}</a></li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="copyright">
                <p>Copyright 2016</p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script>
        jQuery("#picture").unitegallery();
        
    </script> --}}
    @yield('script')
</body>
</html>
