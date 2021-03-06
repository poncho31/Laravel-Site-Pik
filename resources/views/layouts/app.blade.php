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
            list-style-type:circle;
            list-style: square;
        }
        .footerLinks li {
            display: inline-flex;
            padding: 3%;
            /* margin: 3%; */
        }
        .footerLinks li:hover a{
            color:white;
        }
        .footerLinks a {
            color: #444;
            font-weight: bold;
            text-decoration: none;
            /* font-size: 13px; */
            text-transform: uppercase;
        }
        .copyright {
            text-align: center;
        }

        body, .jumbotron{
            background: url('../images/background.jpg') no-repeat center center;
            background-attachment: fixed;
            background-size: cover;
            /* background-position: 0; */
            -webkit-animation-name: backgrAnim;
            -webkit-animation-duration: 1s;
            -webkit-animation-timing-function: ease;
            -webkit-animation-iteration-count: 1;
        }
        .admin:hover{
            opacity: 0.7;
            filter: alpha(opacity=40);
            cursor: pointer;
        }

        hr {
            height: 2px;
            opacity: 0.7;
            color: #7F0000;
            background-color: #7F0000;
        }
        body:before, .jumbotron:before, .HEADER:before, .panel:before, footer:before{
        content: "";
        display: block;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: -10;
        background: url('../images/background.jpg') no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
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
                                    <li class="nav-item{{ route('image.create') }}"><a class="nav-link" href="{{ route('image.create') }}">@lang('Ajouter des images')</a></li>
                                    <li class="nav-item{{ route('in-progress.create') }}"><a class="nav-link" href="{{ route('in-progress.create') }}">@lang('Ajouter un article')</a></li>
                                    <li class="nav-item{{ route('delete') }}"><a class="nav-link" href="{{ route('delete') }}">@lang('Supprimer')</a></li>
                                    <li class="nav-item{{ route('mails-receive') }}"><a class="nav-link" href="{{ route('mails-receive') }}">@lang('Mails reçu')</a></li>
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
        <div class="fixedNavbar" style="height:50px; position:relative; top:0"></div>
        
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        @yield('content')
        <hr>
        <footer>
            <div class="footerLinks" style="position:relative;bottom:0;">
                <ul>
                    @foreach($menu as $section => $v)
                        @foreach($v as $project)
                        <a class="nav-link" href="{{ url("$section/$project") }}">
                            <li class="nav-item">{{ ucfirst(trans($project)) }}</li>
                        </a>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
