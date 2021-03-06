@extends('layouts.picapino')

@section('content')
<div id="wrapper">

    <div id="page-wrapper2" class="gray-bg contenedor2">

        <div class="row">
            <div class="col-md-12">
                <label for="" class="picapino-font">PICAPINO</label>
                <div class="pull-right" style="display: inline-block">
                    <img src="{{asset('img/logo_pink.png')}}" alt="picapino" class="content-to-hide animated fadeInRight" style="height: 7em">
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    {{__('Registro de usuario')}}
                </div>
                <div class="panel-body">
                    <div class="ibox float-e-margins">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            @csrf
                            <p>Al registrarte podras realizar tus compras</p>
                            <div class="form-group">
                                <label for="name" class="col-lg-2 control-label text-md-right">{{ __('Nombre') }}</label>
                                <div class="col-lg-6">
                                    <input id="name" type="text" placeholder="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-lg-2 control-label text-md-right">{{ __('E-Mail') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" placeholder="e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-lg-2 control-label text-md-right">{{ __('Contraseña') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-lg-2 control-label text-md-right">{{ __('Confirmar contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" placeholder="Contraseña" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <div class="i-checks"><label> <input type="checkbox"><i></i> Remember me </label></div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrarse') }}
                                    </button>
                                </div>
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