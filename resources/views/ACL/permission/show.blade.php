@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="card-title">Detalle de permiso</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <label class="d-inline">Guardia:</label>
                        <p class="d-inline">{{ $permission->guard_name }}</p>
                    </div>
                    <hr>
                    <div>
                        <label class="d-inline">Nombre:</label>
                        <p class="d-inline">{{ $permission->name }}</p>
                    </div>
                    <hr>
                    
                    <div>
                        <label class="d-inline">Fecha de creacion:</label>
                        <p class="d-inline">{{ $permission->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection