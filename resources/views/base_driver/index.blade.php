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
                            <a href="{{ route('base_assignment', $user->id)}}" class="btn btn-sm btn-success" role="button">
                                <i class="fas fa-warehouse"></i> Asignar bases
                            </a>                           
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