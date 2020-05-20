<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Picapino') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('inspinia/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/inspinia.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/wow/wow.min.js') }}"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/picapino.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('inspinia/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

</head>

<body id="page-top" class="landing-page no-skin-config FontPicapino">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @if(!auth()->user())
                    <a class="navbar-brand" href="{{ route('login') }}">{{ __('Inicia Sesión') }}</a>
                    @else
                    <a href="{{route('profile.index')}}" class="navbar-brand">{{auth()->user()->name}} {{auth()->user()->last_name}} </a>
                    @endif
                    <a href="" class="navbar-brand-picapino-title" style="padding-left: 1em">
                        <img src="{{asset('img/logo_white.png')}}" alt="picapino" class="animated fadeInRight picapino-logo" style="height: 4em;">
                        <label class="picapino-font-landing-title animated fadeInLeft">PICAPINO</label>
                    </a>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="{{route('landing')}}"><i class="fas fa-home"></i>Inicio</a></li>
                        <li><a class="page-scroll" href="#features"><i class="far fa-address-card"></i>Contacto</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>{{ __('Cerrar sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        <li><a class="page-scroll" href="{{route('checkout')}}"><i class="fas fa-shopping-cart fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>
    @yield('content')
</body>

</html>