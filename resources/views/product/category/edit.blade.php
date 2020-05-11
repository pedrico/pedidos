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
                        <h5>Editar categoría</h5>
                        <div class="ibox-tools">
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="createForm" method="POST" action="{{route('product_category.update', $cat->id)}}" class="form-horizontal">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div id="schools_div_select"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" value="{{ old('name', $cat->name) }}" placeholder="Nombre de la categoría" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Descripción:</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="description" class="form-control" placeholder="Ingresar los principales productos de la categoría separados por diagonal Ejm: Leche / Crema / Queso">{{ old('description', $cat->description) }}</textarea>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('product_category.index')}}" role="button" class="btn btn-secondary ">Cancelar</a>
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