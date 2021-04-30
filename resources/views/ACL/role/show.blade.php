@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="card-title">Detalle de rol</h3>
                </div>
                <div class="panel-body">
                    <div>
                        <label class="d-inline">Guardia:</label>
                        <p class="d-inline">{{ $role->guard_name }}</p>
                    </div>
                    <hr>
                    <div>
                        <label class="d-inline">Nombre:</label>
                        <p class="d-inline">{{ $role->name }}</p>
                    </div>
                    <hr>

                    <div>
                        <label class="d-inline">Fecha de creacion:</label>
                        <p class="d-inline">{{ $role->created_at }}</p>
                    </div>
                    <hr>
                    
                    <div>
                        <label>Permisos del rol:</label>
                        <ul>
                            @for($i = 0; $i < count($role->getPermissionNames()); $i++)
                                <li>
                                    <strong>{{ $role->permissions->toArray()[$i]['name'] }}</strong>
                                </li>
                                @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection