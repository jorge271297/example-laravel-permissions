@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Formulario de permiso</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('permission.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="guard_name" class="control-label">Guardia</label>
                            <input type="text" class="form-control" value="{{ $permission->guard_name }}" disabled>
                            <input id="guard_name" type="text" name="guard_name" value="{{ $permission->guard_name }}"
                                hidden>
                        </div>

                        <div class="form-group">
                            <label for="name" class="control-label">Nombre</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                autocomplete="off" autofocus>
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