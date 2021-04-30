@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 style="display:inline;">Listas de roles</h3>
                    @can('create role')
                    <a href="{{route('role.create')}}" class="btn btn-primary btn-sm" style="float: right;">
                        Agregar
                    </a>
                    @endcan
                </div>
                <div class="panel-body">
                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="role" class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Nombre de Proteccion</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->guard_name}}</td>
                                    <td>
                                        @if(strcasecmp($role->name, 'Super-Admin')!=0)
                                            @can('update role')
                                                <a class="btn btn-xs btn-warning"
                                                    href="{{route('role.edit', $role->id)}}">editar</a>
                                            @endcan
                                            @can('show role')
                                                <a class="btn btn-xs btn-success"
                                                    href="{{route('role.show', $role->id)}}">ver</a>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection