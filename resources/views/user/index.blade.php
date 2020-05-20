@extends('layouts.picapino_master')

@section('content')
<div id="wrapper">
    @include('layouts.sidebar')
    <div id="page-wrapper" class="gray-bg">
        @include('layouts.header')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>e-mail</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th>{{$user->id}} </th>
                        <th>{{$user->name}} {{$user->last_name}} {{$user->second_last_name}} </th>
                        <th>{{$user->email}} </th>
                        <th>
                            @foreach($user->roles as $rol) <span class="badge badge-info">{{$rol->name}}</span>@endforeach
                        </th>
                        <th>
                            @if(!$user->hasRoles(['Driver Base']))
                            <form id="modal-delete-form" method="POST" action="{{ route('user.assign_role', $user->id)}}" class="form-horizontal" style="display: inline">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="rol" value="Driver Base">
                                <button type="submit" class="btn btn-success"><i class="fas fa-truck"></i> Agregar a Drivers Base</button>
                            </form>
                            @endif
                            <form id="modal-delete-form" method="POST" action="{{ route('user.assign_role', $user->id)}}" class="form-horizontal" style="display: inline">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="rol" value="Driver Moto">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-biking"></i> Agregar a Drivers Moto</button>
                            </form>
                        </th>
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