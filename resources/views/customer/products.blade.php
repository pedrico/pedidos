<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Picapino') }}</title>





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
</head>

<body id="page-top" class="landing-page no-skin-config">
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
                    <a class="navbar-brand" href="{{ route('login') }}">{{ __('Inicia Sesión') }}</a>
                    <a href="" class="navbar-brand-picapino-title">
                        <label class="picapino-font-landing-title animated fadeInLeft">PICAPINO</label>
                        <img src="{{asset('img/landing/logo.png')}}" alt="picapino" class="animated fadeInRight picapino-logo" style="height: 4em;">
                    </a>

                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="#page-top">Home</a></li>
                        <li><a class="page-scroll" href="#features">Features</a></li>
                        <li><a class="page-scroll" href="#team">Team</a></li>
                        <li><a class="page-scroll" href="#testimonials">Testimonials</a></li>
                        <li><a class="page-scroll" href="#pricing">Pricing</a></li>
                        <li><a class="page-scroll" href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>
    <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
            <li data-target="#inSlider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="picapino-font-landing">Los mejores estandares <br />
                            de producción</h1>
                        <p style="color: #48558e">Desde la germinación hasta la entrega en tu domicilio.</p>
                        <p>
                            <a class="btn btn-lg btn-primary" href="#" role="button">Conoce más</a>
                            <!-- <a class="caption-link" href="#" role="button">Inspinia Theme</a> -->
                        </p>
                    </div>
                    <div class="carousel-image wow zoomIn" style="text-align: right">
                        <img src="{{ asset('img/landing/tomate4.png') }}" style="width: 50%" alt="pinia" />
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back one"></div>

            </div>
            <div class="item">
                <div class="container">
                    <div class="carousel-caption blank">
                        <h1>We create meaningful <br /> interfaces that inspire.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
                <!-- Set background for slide in css -->
                <div class="header-back two"></div>
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

    <section class="container features">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1>Categorías<br />
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                @foreach($arreglo as $item)
                <div class="col-lg-4">
                    <div class="widget-head-color-box navy-bg p-lg text-center sombra">
                        <div class="m-b-md">
                            <h2 class="font-bold no-margins">
                                Categoría {{$item}}
                            </h2>
                            <small>Founder of Groupeq</small>
                        </div>
                        <img src="img/landing/lacteos.webp" style="width: 100%;" class="img-circle circle-border m-b-md" alt="categoria">
                        <div>
                            <span>Leche</span> |
                            <span>Queso</span> |
                            <span>Crema</span>
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

</body>

</html>