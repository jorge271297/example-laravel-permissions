@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Formulario de rol</h3>
                </div>
                <div class="panel-body">
                    @if($role->exists)
                    <form action="{{route('role.update', $role->id)}}" method="POST">
                        {{ method_field('PUT') }}
                        <input type="text" name="id" value="{{ $role->id }}" hidden>
                    @else
                    <form action="{{route('role.store')}}" method="POST">
                    @endif
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="guard_name">Guardia</label>
                                <input type="text" class="form-control" value="{{ $role->guard_name }}" disabled>
                                <input type="text" name="guard_name" value="{{ $role->guard_name }}" hidden>
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{ $role->name }}"
                                    autocomplete="off" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="roles" class="form-label">Permisos de rol</label>
                                @foreach ($permissions as $permission)
                                <div class="form-check form-check">
                                    <input type="checkbox" class="form-check-input" name="permissions[]"
                                        value="{{ $permission->name }}" @if(in_array($permission->name,
                                    $role->getPermissionNames()->toarray())) checked @endif >
                                    <strong>
                                        <label class="form-check-label" for="exampleCheck1">
                                            {{ $permission->name }}
                                        </label>
                                    </strong>
                                </div>
                                @endforeach
                            </div>

                            @if($errors->any())
                            <div class="alert alert-danger">
                                <strong>¡Ups!</strong> Hubo algunos problemas con su entrada.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            
                            <hr>
                            <input type="submit" name="submit" class="btn btn-success" value="Enviar Formulario">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection