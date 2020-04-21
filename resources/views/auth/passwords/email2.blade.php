@extends('layouts.picapino')

@section('content')
<div id="wrapper">

    <div id="page-wrapper2" class="gray-bg contenedor2">

        <div class="row">
            <div class="col-md-12">
                <label for="" class="picapino-font">PICAPINO</label>
                <div class="pull-right" style="display: inline-block">
                    <img src="{{asset('img/Trazado 7@2x.png')}}" alt="picapino" class="content-to-hide animated fadeInRight" style="height: 7em">
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            {{__('Reestablecer contraseña')}}
                        </div>
                        <div class="panel-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="ibox float-e-margins">
                                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="form-group">
                                            <label for="email" class="col-md-4 control-label text-md-right">{{ __('E-Mail') }}</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" placeholder="e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Enviar link de restablecimiento') }}
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
        </div>
        @include('layouts.footer')
    </div>
</div>


@endsection