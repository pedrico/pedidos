@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        @include('layouts.index_delete_modal')
        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <a href="{{ url('product/create')}}" class="btn btn-success" role="button">
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
                        <th>Descripción</th>
                        <th>Medida</th>
                        <th>Imágen</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $prod)
                    <tr>
                        <td>{{$prod->id}} </td>
                        <td>{{$prod->name}} </td>
                        <td>{{$prod->description}} </td>
                        <td>{{$prod->unit}} </td>
                        <td>Q. {{$prod->price}} </td>
                        <td>
                            @if($prod->image_name)
                            <img alt="image" class="img-circle" src="/upload/product/{{$prod->image_name}}.jpg" style="width: 50px; height: 50px" />
                            @else
                            Sin imágen
                            @endif
                            <form method="POST" action="{{route('product_update_image')}}" class="form-horizontal" style="display: inline">
                                {!! csrf_field() !!}
                                <input type="hidden" name="product_id" value="{{$prod->id}}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i></button>
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" id="{{$prod->id}}" name="status" class="js-switch" value="{{$prod->id}}" data-url="{{asset('product/id/status')}}" {{($prod->status == 1 ? 'checked' : '')}}>
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $prod->id)}}" class="btn btn-sm btn-success" role="button">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('product_category_assignment', $prod->id)}}" class="btn btn-sm btn-success" role="button">
                                <i class="fas fa-braille"></i> Asignar Categorías
                            </a>
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-toggle="modal" data-target="#delete-modal" data-name="{{$prod->name}}" data-action="{{ route('product.destroy', $prod->id)}}">
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
        $('#modal-delete-form').attr("action", $(this).data("action"));
    });
</script>
@endsection