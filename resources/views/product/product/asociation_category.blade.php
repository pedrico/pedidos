@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        <div class="row">
            <div class="col-md-12">
                <h3> Asignando categorías al producto {{$product->name}}</h3>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr>
                        <td>{{$cat->id}} </td>
                        <td>{{$cat->name}} </td>
                        <td>{{$cat->description}} </td>
                        <th>
                            @if($cat->product_id)
                            <span class="badge badge-info">Asignando</span>
                            @else
                            <span class="badge badge-badge-light">No asignando</span>
                            @endif
                        </th>
                        <td>
                            @if(!$cat->product_id)
                            <form id="modal-delete-form" action="{{ route('product_category_assign',[$product->id, $cat->id, 1])}}" method="POST" class="form-horizontal" style="display: inline">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success"><i class="fas fa-link"></i> Asignar</button>
                            </form>
                            @else
                            <form id="modal-delete-form" action="{{ route('product_category_assign',[$product->id, $cat->id, 0])}}" method="POST" class="form-horizontal" style="display: inline">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-warning"><i class="fas fa-unlink"></i> Desasignar</button>
                            </form>
                            @endif
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
@endsection