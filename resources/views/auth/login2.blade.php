@extends('layouts.login')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset('img/Trazado 7@2x.png')}}" alt="" width="100%">
            </div>
        </div>
        <div>
            <h2 class="picapino-font">PICAPINO</h2>
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
            <button type="submit" class="btn btn-primary block full-width m-b">Iniciar Sesión</button>

            <a href="{{ route('password.request') }}"><small>¿Olvidaste tu contraseña?</small></a>
            <p class="text-muted text-center"><small>{{ __('¿No tienes una cuenta?') }}</small></p>

            <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">{{ __('Crear cuenta') }}</a>
        </form>
        <p class="m-t"> <small>Full Compliance Group &copy; 2020</small> </p>
    </div>
</div>
@endsection