@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="card-title">Formulario de usuario</h3>
    </div>

    <div class="card-body f-z-12">
        @if($user->exists)
        {!! Form::open(['route' => ['user.update', $user->id], 'method' => 'put', 'id' => 'form']) !!}
        <input type="text" name="id" value="{{ $user->id }}" hidden>
        @else
        {!! Form::open(['route' => [ 'user.register'], 'method' => 'POST', 'id' => 'form'])!!}
        @endif
        <div class="form-group">
            <label for="name" class="control-label">Nombre</label>
            <select name="employee_id" class="select2">
                <option value="">SELECCIONE UNA OPCION</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}"
                        @if($user->employee_id == $employee->id ) selected @endif>
                        {{ $employee->name }} {{ $employee->paternal_surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="email" class="control-label">Direccion de correo electronico</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}"
                autocomplete="off">
        </div>
        @if(!$user->exists)
        <div class="form-group">
            <label for="password" class="control-label">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" autocomplete="off">
        </div>

        <div class="form-group">
            <label for="password-confirm" class="control-label">Confirmar contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                autocomplete="off">
        </div>
        @endif

        @if($user->employee_id == auth()->user()->employee_id)
        <div class="form-group">
            <label for="roles" class="form-label">Rol de usuario</label>
            @foreach ($roles as $rol)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" value="{{ $rol->name }}"
                    @if(in_array($rol->name, $user->getRoleNames()->toArray())) checked @endif disabled>
                <strong><label class="form-check-label" for="exampleCheck1">{{ $rol->name }}</label></strong>
                <i>({{ $rol->description }})</i>
            </div>
            @endforeach
        </div>
        @endif

        <div class="form-group" @if($user->employee_id == auth()->user()->employee_id) hidden @endif>
            <label for="roles" class="form-label">Rol de usuario</label>
            @foreach ($roles as $rol)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="roles[]" value="{{ $rol->name }}"
                    @if(in_array($rol->name, $user->getRoleNames()->toArray())) checked @endif >
                <strong><label class="form-check-label" for="exampleCheck1">{{ $rol->name }}</label></strong>
                <i>({{ $rol->description }})</i>
            </div>
            @endforeach
        </div>

        <hr>
        @include('layouts._error')
        <input type="submit" name="submit" class="btn btn-success" value="Enviar Formulario">

        {!! FORM::close() !!}
    </div>
</div>
@endsection
