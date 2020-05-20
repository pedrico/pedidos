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
                <div class="ibox">
                    <div class="ibox-content product-box ">
                        <div class="text-center">
                            <a href="">
                                <div style="display: inline-block;">
                                    <img src="/upload/product/{{$item->image_name}}.{{$item->image_extension}}" class="img-circle circle-border m-b-md" style="width: 100%; height: 100%" alt="producto">
                                </div>
                            </a>
                        </div>
                        <div class="product-desc">
                            <span class="product-price" style="background-color: #6699cc; font-size: 1em">
                                Q.{{$item->price}} / {{$item->unit}}
                            </span>
                            <small class="text-muted">{{$item->category}}</small>
                            <a href="#" class="product-name"> {{$item->name}}</a>
                            <div class="small m-t-xs">
                                {{$item->description}}
                            </div>
                            <div>
                                <div class=" m-t text-righ">
                                    <a href="#" class="btn btn-xs btn-outline btn-primary">Detalles <i class="fas fa-caret-right"></i> </a>
                                    <!-- <div class="picapino-quantity-control" >
                                            <div style="display: flex;  margin-right:0; margin-left: 0" class=" quantity-select ">
                                                <button name="button" type="button" class="quantity-select-increase" style="border-right:0; flex-grow:0; flex-shrink:0; padding-top:0; padding-right:1rem; padding-left:1rem; ">-</button>
                                                <input type="number" name="quantity" id="quantity" value="1" min="1" style="padding: 0;flex-grow:1;flex-shrink:1; text-align: center;border-left:0; border-right:0;" class=" form-control quantity-select-value">
                                                <button name="button" type="button" class="quantity-select-increase" style="border-left:0;  flex-grow:0; flex-shrink:0; padding-top:0; padding-right:1rem; padding-left:1rem; ">+</button>
                                            </div>
                                        </div> -->

                                    <div class="picapino-quantity-control">
                                        <form method="POST" action="{{route('add_cart_product')}}" class="form-horizontal" style="display: inline">
                                            {{ csrf_field() }}
                                            <button class="btn btn-success quantity" data-type='less' data-id="{{$item->id}}" onclick="event.preventDefault();">-</button>
                                            <input id="quantity{{$item->id}}" name="quantity" class="form-control" type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" style="width: 4em; display: inline-block; text-align: right" value="1">
                                            <button class="btn btn-success quantity" data-type='more' data-id="{{$item->id}}" onclick="event.preventDefault();">+</button>
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="product_id" value="{{$item->id}}">
                                            <button data-id="{{$item->id}}" type="submit" style="font-size: 2em; padding-left: 6px; padding-top: 0px; padding-bottom: 0px; padding-right: 7px" class="btn btn-primary add_to_cart" onclick="event.preventDefault();"><i class="fas fa-shopping-cart"></i></button>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>
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

        //Logica para el control de cantidad
        $('.quantity').on('click', function() {
            var type = $(this).data("type");
            var id = '#quantity' + $(this).data('id');
            var valor = $(id).val();
            console.log(valor);
            if (isNaN(valor) || valor == null || valor == "") {
                console.log("es nan");
                $(id).val(1);
            } else {
                var quantity = parseInt(valor);
                if (type == "more" && quantity) {
                    valor = quantity + 1;
                    if (valor <= 100) {
                        $(id).val(quantity + 1);
                    }
                } else {
                    valor = quantity - 1;
                    if (valor > 0) {
                        $(id).val(quantity - 1);
                    }
                }
            }
        });

        //Agregar producto
        $('.add_to_cart').on('click', function() {
            var product_id = $(this).data('id');
            var quantity = $('#quantity' + product_id).val();
            var url = '{{asset("add_cart_product")}}';
            var token = $('input[name=_token]').val();
            jQuery.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    '_token': token,
                    'product_id': product_id,
                    'quantity': quantity
                },
                success: function(data) {
                    toastr.success('Producto agregado', data.result);
                },
                error: function(error) {
                    toastr.success('Se ha producido un error, por favor comunicate con Picapino.', '¡ERROR!');
                }
            });
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
@endsection