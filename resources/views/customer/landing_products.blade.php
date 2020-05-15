@extends('layouts.picapino_master')

@section('content')

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
                        <li><a class="page-scroll" href="#team"><i class="fas fa-shopping-cart fa-2x"></i></a></li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>
    <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <!-- <li data-target="#inSlider" data-slide-to="1"></li> -->
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back one"></div>

            </div>
        </div>
        <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div>
        <img src="{{ asset('img/landing/Infografia.jpg') }}" style="width: 100%" alt="pinia" />
    </div>
    <section class="container features" id="products">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>{{$cat->name}}<br />
            </div>
        </div>
        <div class="wrapper wrapper-content">
            <div class="row">
                @foreach($products as $item)
                <div class="{{ ($loop->index % 2 == 0) ? 'col-lg-4 animated fadeInRight' : 'col-lg-4 animated fadeInLeft'}}">
                    <div class=" text-center ">
                        <!-- <div class="widget-head-color-box navy-bg p-lg text-center sombra"> -->
                        <a href="">
                            <div style="display: inline-block;">
                                <img src="/upload/product/{{$item->image_name}}.{{$item->image_extension}}" class="img-circle circle-border m-b-md" style="width: 100%; height: 100%" alt="producto">
                            </div>
                        </a>
                        <div class="m-b-md product-desc">
                            <h2 class="font-bold no-margins" style="color: #e26141; padding-bottom: 5px">
                                <span class="product-price badge" style="background-color: #6699cc; font-size: 1em">
                                    Q.{{$item->price}}
                                </span>
                                {{$item->name}}
                            </h2>
                            <span>{{$item->description}}</span>
                            <p><span class="badge badge-primary" style="background-color: #6699cc; font-size: 1em">Q.{{$item->price}}</span></p>
                        </div>
                    </div>
                    <!-- <div class="widget-text-box">
                        <h4 class="media-heading">Alex Smith</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="text-right">
                            <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                            <a class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                        </div>
                    </div> -->
                </div>
                <div class="{{ ($loop->index % 2 == 0) ? 'col-lg-4 animated fadeInRight' : 'col-lg-4 animated fadeInLeft'}}">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                            <a href="">
                                <div style="display: inline-block;">
                                    <img src="/upload/product/{{$item->image_name}}.{{$item->image_extension}}" class="img-circle circle-border m-b-md" style="width: 100%; height: 100%" alt="producto">
                                </div>
                            </a>
                            <div class="product-desc">
                                <span class="product-price" style="background-color: #6699cc; font-size: 1em">
                                    Q.{{$item->price}}
                                </span>
                                <small class="text-muted">Category</small>
                                <a href="#" class="product-name"> {{$item->name}}</a>
                                <div class="small m-t-xs">
                                    {{$item->description}}
                                </div>
                                <div class="m-t text-righ">
                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Detalles <i class="fas fa-caret-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </section>



    <!-- Scripts -->
    <script src="{{ asset('inspinia/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('inspinia/js/inspinia.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('inspinia/js/plugins/wow/wow.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            window.location.hash = '#products';
            $('body').scrollspy({
                target: '.navbar-fixed-top',
                offset: 80
            });

            // Page scrolling feature
            $('a.page-scroll').bind('click', function(event) {
                var link = $(this);
                $('html, body').stop().animate({
                    scrollTop: $(link.attr('href')).offset().top - 50
                }, 500);
                event.preventDefault();
                $("#navbar").collapse('hide');
            });
        });

        var cbpAnimatedHeader = (function() {
            var docElem = document.documentElement,
                header = document.querySelector('.navbar-default'),
                didScroll = false,
                changeHeaderOn = 200;

            function init() {
                window.addEventListener('scroll', function(event) {
                    if (!didScroll) {
                        didScroll = true;
                        setTimeout(scrollPage, 250);
                    }
                }, false);
            }

            function scrollPage() {
                var sy = scrollY();
                if (sy >= changeHeaderOn) {
                    $(header).addClass('navbar-scroll')
                } else {
                    $(header).removeClass('navbar-scroll')
                }
                didScroll = false;
            }

            function scrollY() {
                return window.pageYOffset || docElem.scrollTop;
            }
            init();

        })();

        // Activate WOW.js plugin for animation on scrol
        new WOW().init();
    </script>
    <script>
    </script>
</body>

@endsection