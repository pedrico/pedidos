@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{__('Personaliza tu información')}}
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('profile.update', auth()->user()->id) }}">
                            <div class="form-group">
                                <label for="name" class="col-lg-2 control-label text-md-right">{{ __('Primer nombre') }}</label>
                                <div class="col-lg-6">
                                    <input id="name" type="text" placeholder="Primer nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', auth()->user()->name)  }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="second_name" class="col-lg-2 control-label text-md-right">{{ __('Segundo nombre') }}</label>
                                <div class="col-lg-6">
                                    <input id="second_name" type="text" placeholder="Segundo nombre" class="form-control @error('second_name') is-invalid @enderror" name="second_name" value="{{ old('name', auth()->user()->second_name)  }}" autocomplete="second_name" autofocus>
                                    @error('second_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-lg-2 control-label text-md-right">{{ __('Primer apellido') }}</label>
                                <div class="col-lg-6">
                                    <input id="last_name" type="text" placeholder="Primer apellido" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', auth()->user()->last_name)  }}" required autocomplete="last_name" autofocus>
                                    @error('last_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="second_last_name" class="col-lg-2 control-label text-md-right">{{ __('Segundo apellido') }}</label>
                                <div class="col-lg-6">
                                    <input id="second_last_name" type="text" placeholder="Segundo apellido" class="form-control @error('second_last_name') is-invalid @enderror" name="second_last_name" value="{{ old('name', auth()->user()->second_last_name)  }}" required autocomplete="second_last_name" autofocus>
                                    @error('second_last_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar información') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        {{__('Sube tu imagen de perfil')}}
                                    </div>
                                    <div class="ibox-content">
                                        <form action="{{route('profile_image')}}" class="dropzone" id="dropzoneForm">
                                            @csrf
                                            <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>
                                        </form>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Direcciones -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{__('Direcciones de entrega')}}
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach(auth()->user()->addresses as $address)
                                <div class="{{ ($loop->index % 2 == 0) ? 'col-lg-2 animated fadeInRight' : 'col-lg-2 animated fadeInLeft'}}">
                                    <div class=" navy-bg p-lg text-center sombra fondo-card">
                                        <div>
                                            <b>Dirección {{$address->address}}</b>
                                        </div>
                                        <div>
                                            <span>{{$address->indications}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="padding-left: 3px; padding-right: 3px; padding-top: 5px" style="border: dashed"><span class="badge badge-info" style="display: block">Editar</span></div>
                                    <div class="col-lg-6" style="padding-left: 3px; padding-right: 3px; padding-top: 5px">
                                        <form name="delete_form_{{$address->id}}" class="form-horizontal" method="POST" action="{{ route('address.destroy', $address->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <span class="badge badge-danger" role="button" type="submit" onclick="delete_form_{{$address->id}}.submit()" style="display: block">Eliminar</span>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div id="div_agregar_dir" class="col-lg-12">
                                <button id="btn_agregar_dir" data-animation="fadeInRightBig" class="btn btn-primary"><i class="fa fa-plus"></i> Registrar una dirección de entrega </button>
                            </div>
                        </div>
                        <div id="animation_box2" class="col-lg-12" style="display: none">
                            <button id="btn_dir_actual" data-animation="fadeInRightBig" class="btn btn-primary"><i class="fa fa-plus"></i> Registrar ubicación actual </button>
                            <button id="btn_dir_dif" data-animation="fadeInRightBig" class="btn btn-success"><i class="fa fa-plus"></i> Registrar otra ubicación </button>
                        </div>
                        <div id="animation_box3" class="col-lg-12" style="display: none">
                            <form class="form-horizontal" method="POST" action="{{ route('address.store') }}">
                                @csrf
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
                                <div class="row">
                                    <div class="form-group">
                                        <label for="address" class="col-lg-2 control-label text-md-right">{{ __('Escribe tu dirección') }}</label>
                                        <div class="col-lg-6">
                                            <input id="address" type="text" placeholder="Ingresa tu dirección" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address')  }}" required autocomplete="address" autofocus>
                                            @error('address')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $address }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="indications" class="col-lg-2 control-label text-md-right">{{ __('Por favor escribe indicaciones que puedan ayudar a nuestro repartidor a llegar a tu ubicación:') }}</label>
                                        <div class="col-lg-6">
                                            <input id="indications" type="text" placeholder="Ingresa indicaciones cercanas a tu ubicación" class="form-control @error('indications') is-invalid @enderror" name="indications" value="{{ old('indications')  }}" required autocomplete="indications" autofocus>
                                            @error('indications')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $indications }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Registrar dirección') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Telefonos -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{__('Números telefónico de contacto')}}
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach(auth()->user()->phones as $phone)
                                <div class="{{ ($loop->index % 2 == 0) ? 'col-lg-2 animated fadeInRight' : 'col-lg-2 animated fadeInLeft'}}">
                                    <div class=" navy-bg p-lg text-center sombra fondo-card">
                                        <div>
                                            <b>Tel: {{$phone->number}}</b>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" style="padding-left: 3px; padding-right: 3px; padding-top: 5px" style="border: dashed"><span class="badge badge-info" style="display: block">Editar</span></div>
                                    <div class="col-lg-6" style="padding-left: 3px; padding-right: 3px; padding-top: 5px">
                                        <form name="delete_form_phone{{$phone->id}}" class="form-horizontal" method="POST" action="{{ route('phone.destroy', $phone->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <span class="badge badge-danger" role="button" type="submit" onclick="delete_form_phone{{$phone->id}}.submit()" style="display: block">Eliminar</span>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div id="div_agregar_tel" class="col-lg-12">
                                <button id="btn_agregar_tel" data-animation="fadeInRightBig" class="btn btn-primary"><i class="fa fa-plus"></i> Registrar un número telefónico </button>
                            </div>
                        </div>
                        <div id="animation_box4" class="col-lg-12" style="display: none">
                            <form class="form-horizontal" method="POST" action="{{ route('phone.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="telefono" class="col-lg-2 control-label text-md-right">{{ __('Número de teléfono') }}</label>
                                        <div class="col-lg-6">
                                            <input id="number" type="number" min="10000000" max="99999999" placeholder="Número telefónico" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number')  }}" required autocomplete="number" autofocus>
                                            @error('number')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Registrar número') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection
@section('page-scripts')
<script>
    var x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
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
</script>
<script>
    $(document).ready(function() {
        $('#btn_agregar_dir').click(function() {
            // Direcciones
            $('#div_agregar_dir').removeAttr('class').attr('class', '');
            $('#div_agregar_dir').addClass('animated');
            $('#div_agregar_dir').addClass('fadeOutLeftBig');
            $('#div_agregar_dir').hide(1000);

            $('#animation_box2').removeAttr('class').attr('class', '');
            var animation = $(this).attr("data-animation");
            $('#animation_box2').show();
            $('#animation_box2').addClass('animated');
            $('#animation_box2').addClass(animation);
            return false;
        });

        $('#btn_dir_actual').click(function() {
            getLocation();
            $('#animation_box2').removeAttr('class').attr('class', '');
            $('#animation_box2').addClass('animated');
            $('#animation_box2').addClass('fadeOutLeftBig');
            $('#animation_box2').hide(1000);

            $('#animation_box3').removeAttr('class').attr('class', '');
            var animation = $(this).attr("data-animation");
            $('#animation_box3').show();
            $('#animation_box3').addClass('animated');
            $('#animation_box3').addClass(animation);

        });

        // Números Telefonos
        $('#btn_agregar_tel').click(function() {
            $('#div_agregar_tel').removeAttr('class').attr('class', '');
            $('#div_agregar_tel').addClass('animated');
            $('#div_agregar_tel').addClass('fadeOutLeftBig');
            $('#div_agregar_tel').hide(1000);

            $('#animation_box4').removeAttr('class').attr('class', '');
            var animation = $(this).attr("data-animation");
            $('#animation_box4').show();
            $('#animation_box4').addClass('animated');
            $('#animation_box4').addClass(animation);
            return false;
        });

    });
</script>
<script>
    Dropzone.options.dropzoneForm = {
        paramName: "profileImg", // The name that will be used to transfer the file
        maxFilesize: 1, // MB
        acceptedFiles: ".jpg, jpeg",
        dictDefaultMessage: "Arrastra tu fotografía hacia acá.",
        dictInvalidFileType: "No puedes subir archivos de este tipo",
        accept: function(file, done) {
            console.log("uploaded");
            done();
        },
        init: function() {
            this.on("addedfile", function() {
                if (this.files[1] != null) {
                    this.removeFile(this.files[0]);
                }
            });
        }
    };
</script>
@endsection