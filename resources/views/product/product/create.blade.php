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
                        <h5>Registrar nuevo producto</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="createForm" method="POST" action="{{route('product.store')}}" class="form-horizontal">
                            {!! csrf_field() !!}
                            <div id="schools_div_select"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Nombre del producto" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripción:</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="description" class="form-control" placeholder="Ingrese la descripción del producto.">{{old('description')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unidad de venta:</label>
                                <div class="col-sm-10">
                                    <select id="measurement_unit_id" name="measurement_unit_id" class="chosen-select form-control" required>
                                        <option value="">[seleccione una unidad]</option>
                                        @foreach($measurement_units as $mu)
                                        <option value="{{$mu->id}}" {{ (old('measurement_unit_id') == $mu->id ? 'selected':"") }}>{{$mu->unit}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Precio:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="price" step="0.01" class="form-control" value="{{old('price')}}" placeholder="Precio" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('product.index')}}" role="button" class="btn btn-secondary ">Cancelar</a>
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
@endsection