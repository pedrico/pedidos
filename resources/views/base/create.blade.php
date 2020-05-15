@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Registrar nueva base</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="createForm" method="POST" action="{{route('base.store')}}" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div id="schools_div_select"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Nombre de la base" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Dirección:</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="address" class="form-control" placeholder="Dirección de la base" require>{{old('address')}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <input name="lat" type="hidden" id="lat">
                            </div>
                            <div class="col-lg-3">
                                <input name="lng" type="hidden" id="lng">
                            </div>
                            <div class="col-lg-12">
                                <iframe width="99%" height="450" frameborder="0" style="border:0" src="" allowfullscreen id="myFrame">
                                </iframe>
                                <p id="demo"></p>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('base.index')}}" role="button" class="btn btn-secondary ">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    </div>
</div>
@endsection
@section('page-scripts')
<script src="{{ asset('inspinia/js/picapino.js') }}"></script>
<script>
    $(document).ready(function() {
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            console.log("posicion");
            var myFrame = document.getElementById("myFrame");
            $('#lat').val(position.coords.latitude);
            $('#lng').val(position.coords.longitude);
            // x.innerHTML = "Latitude: " + position.coords.latitude +
            //     "<br>Longitude: " + position.coords.longitude;
            lati = position.coords.latitude;
            long = position.coords.longitude;

            var ruta = "https://picapino.test/map/" + lati + "/" + long;
            console.log(ruta);

            myFrame.src = ruta;
        }
        getLocation();
    })
</script>
@endsection