@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        <form class="form-horizontal" method="POST" action="{{ route('profile.update', auth()->user()->id) }}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{__('Personaliza tu información')}}</h5>
                        </div>
                        <div class="ibox-content">
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
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Direcciones -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{__('Direcciones de entrega')}}</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" action="{{ route('profile.update', auth()->user()->id) }}">
                            @method('PUT')
                            @csrf
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

                        <p>Click the button to get your coordinates.</p>

                        <button onclick="getLocation()">Try It</button>

                        <p id="demo"></p>
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
        console.log('navegando');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }
</script>
@endsection