@extends('layouts.login')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div class="row content-to-hide" style="height: 13em">

        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('img/logo_white.png')}}" alt="" width="50%">
            </div>
        </div>
        <div>
            <h2 class="picapino-font" style="padding-bottom: 10px">PICAPINO</h2>
        </div>
        <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
                @error('email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="contraseña">
                @error('password')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b" style="background-color: #66d7d1; border-color: #66d7d1" >Iniciar Sesión</button>

            <a href="{{ route('password.request') }}" style="color: #ffffff; font-weight: 600">¿Olvidaste tu contraseña?</a>
            
            <div class="row" style="padding: 2em">
                <p class="text-center" style="color: #ffffff; font-weight: 400">{{ __('¿No tienes una cuenta?') }}</p>
    
                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}" style="font-weight: 400">{{ __('Crear cuenta') }}</a>
            </div>
        </form>
        <p class="m-t" style="color: #ffffff"> <small>Full Compliance Group &copy; 2020</small> </p>
    </div>
</div>
@endsection