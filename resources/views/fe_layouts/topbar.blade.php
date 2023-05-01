<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Prozim - Find a Professional and Book a Consultation by Appointment, Chat or Video call">
    <meta name="author" content="Ansonika">
    <title>Optimis PTN</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- BASE CSS -->
    <link href="{{ asset('fe_assets/css/bootstrap_customized.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fe_assets/css/style.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('fe_assets/css/listing.css') }}" rel="stylesheet">
    <link href="{{ asset('fe_assets/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('fe_assets/css/detail-page.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('fe_assets/css/custom.css') }}" rel="stylesheet">
    
    @yield('css')
</head>

<body>

    <header class="header_in clearfix">
        <div class="container">
            <div id="logo">
                @auth
                    @if (auth()->user()->role == 'admin')
                        <a href="/admin-dashboard">
                            <img src="{{ asset('logo1.png') }}" style="height: 40px;" alt="">
                        </a>    
                    @else
                        <a href="/">
                            <img src="{{ asset('logo1.png') }}" style="height: 40px;" alt="">
                        </a>
                    @endif   
                @else
                <a href="/">
                    <img src="{{ asset('logo1.png') }}" style="height: 40px;" alt="">
                </a>
                @endauth
                
            </div>
            <ul id="top_menu">
                @auth
                    <li>
                        <a class="btn_access" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @if (auth()->user()->role == 'admin')
                        <li><a href="/admin-dashboard" class="btn_access">Dashboard</a></li>    
                    @endif
                @else
                    <li><a href="/login" class="btn_access">Log In</a></li>
                @endauth

                
            </ul>
            <!-- /top_menu -->
            <a href="#0" class="open_close">
                <i class="icon_menu"></i><span>Menu</span>
            </a>
            <nav class="main-menu">
                <div id="header_menu" style="background-color: rgb(116, 141, 141)">
                    <a href="#0" class="open_close">
                        <i class="icon_close"></i><span>Menu</span>
                    </a>
                    <a href="/admin-dashboard">
                        <img src="{{ asset('logo1.png') }}" style="height: 40px;" alt="">
                    </a> 
                    {{-- <a href="/" style="color: white">Optimis PTNa</a> --}}
                </div>
                <ul>
                   
                    @auth
                    @if (auth()->user()->role == 'admin')
                        {{-- <li>
                            <a href="/admin-dashboard">Dashboard</a>
                        </li>
                        <li>
                            <li>
                                <a class="btn_access" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </li> --}}
                        <li>
                            <a href="/my-info">PROFILE</a>
                        </li>
                        @else
                        <li>
                            <a href="#" id="profile">PROFILE</a>
                        </li>
                        @endauth
                        <li>
                            @auth
                                <a href="/daftar-ptn">DAFTAR PTN</a>
                            @else
                                <a href="#" id="daftar_ptn">DAFTAR PTN</a>
                            @endauth
                        </li>
                    @endif
                    {{-- <li class="submenu"> --}}
                        @auth
                        <li>
                            <li>
                                <a class="btn_access" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    {{ __('LOGOUT') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </li>
                        @endauth
                       
                </ul>
            </nav>
        </div>
    </header>
    <!-- /header -->
    <main class="bg_color">
