@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        @include('layouts.index_delete_modal')
        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <a href="{{ url('base/create')}}" class="btn btn-success" role="button">
                    <i class="fa fa-plus"></i> <strong>Nuevo</strong>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bases as $base)
                    <tr>
                        <td>{{$base->id}} </td>
                        <td>{{$base->name}} </td>
                        <td>{{$base->address}} </td>
                        <td>{{$base->lat}}</td>
                        <td>{{$base->lng}}</td>
                        <td>
                            <input type="checkbox" id="{{$base->id}}" name="status" class="js-switch" value="{{$base->id}}" data-url="{{asset('base/id/status')}}" {{($base->status == 1 ? 'checked' : '')}}>
                        </td>
                        <td>
                            <a href="{{ route('base.edit', $base->id)}}" class="btn btn-sm btn-success" role="button">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-toggle="modal" data-target="#delete-modal" data-name="{{$base->name}}" data-action="{{ route('base.destroy', $base->id)}}">
                                <i class="far fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        @include('layouts.footer')
    </div>
</div>
@endsection
@section('page-scripts')
<script src="{{ asset('inspinia/js/picapino.js') }}"></script>
<script>
    $(".btn-delete").click(function(event) {        
        $('#modal-element-name').text($(this).data("name"));
        $('#modal-delete-form').attr("action",$(this).data("action"));
    });
</script>
@endsection