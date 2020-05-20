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

<div class="row">
    <div class="col-lg-12 text-center">
        <div class="navy-line"></div>
        <h1>Resumen de compra<br />
    </div>
</div>
<section class="container features" id="products">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-8">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right">(<strong>{{$quantity->quantity}}</strong>) items</span>
                        <h5>Productos en tu orden</h5>
                    </div>
                    @foreach($products as $p)
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shoping-cart-table">
                                <tbody>
                                    <tr>
                                        <td width="90">
                                            <div class="cart-product-imitation">
                                            </div>
                                        </td>
                                        <td class="desc">
                                            <h3>
                                                <a href="#" class="text-navy">
                                                    {{$p->name}}
                                                </a>
                                            </h3>
                                            <!-- <p class="small">
                                                {{$p->description}}
                                            </p> -->
                                            <dl class="small m-b-none">
                                                <dt> {{$p->description}}</dt>
                                                <!-- <dd>A description list is perfect for defining terms.</dd> -->
                                            </dl>
                                            <div class="m-t-sm">
                                                <a href="#" class="text-muted"><i class="fa fa-trash"></i> Remove item</a>
                                            </div>
                                        </td>

                                        <td>
                                            Q.{{$p->price}}/{{$p->unit}}
                                        </td>
                                        <td width="65">
                                            <input type="text" class="form-control" placeholder="1" value="{{$p->quantity}}">
                                        </td>
                                        <td>
                                            <h4>
                                                {{$p->quantity * $p->price}}
                                            </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                    <div class="ibox-content">
                        <button class="btn btn-primary pull-right"><i class="fa fa fa-shopping-cart"></i> Realizar pedido</button>
                        <a href="{{route('landing')}}" class="btn btn-white"><i class="fa fa-arrow-left"></i> Continuar comprando</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Resumen de compra</h5>
                    </div>
                    <div class="ibox-content">
                        <span>
                            Total
                        </span>
                        <h2 class="font-bold">
                            Q. {{$total->total}}
                        </h2>
                        <hr>
                        <span class="text-muted small">
                            *Costo de envío
                        </span>
                        <div class="m-t-sm">
                            <div class="btn-group">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Realizar pedido</a>
                                <a href="#" class="btn btn-white btn-sm"> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-title">
                        <h5>¿Necesitas ayuda?</h5>
                    </div>
                    <div class="ibox-content text-center">
                        <h3><i class="fa fa-phone"></i> +502 5566 8899</h3>
                        <span class="small">
                            Si tienes alguna duda de como realizar tu pedido por favor contactanos.
                        </span>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-content">

                    </div>
                </div>

            </div>
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