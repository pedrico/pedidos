@extends('layouts.landing_master')

@section('content')
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
<section class="container features">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="navy-line"></div>
            <h1>Categorías<br />
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            @foreach($categories as $item)
            <div class="{{ ($loop->index % 2 == 0) ? 'col-lg-4 animated fadeInRight' : 'col-lg-4 animated fadeInLeft'}}">
                <div class=" text-center ">
                    <!-- <div class="widget-head-color-box navy-bg p-lg text-center sombra"> -->
                    <a href="{{route('landing_products', $item->id)}}">
                        <div style="display: inline-block;">
                            <img src="upload/product_category/{{$item->image_name}}.{{$item->image_extension}}" class="img-circle circle-border m-b-md" style="width: 100%; height: 100%" alt="categoria">
                        </div>
                    </a>
                    <div class="m-b-md">
                        <h2 class="font-bold no-margins" style="color: #e26141">
                            {{$item->name}}
                        </h2>
                        <span>{{$item->description}}</span>
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
@endsection