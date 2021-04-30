@extends('layouts.app')
@section('content')
<li class="breadcrumb-item">
    <a href="{{ route('user.index') }}">ADMIN</a>
</li>
<li class="breadcrumb-item">USUARIOS</li>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-black">
            <h3 class="card-title">Listas de usuarios</h3>
            @can('user.create')
            <a id="btnagregar" onclick="showAjaxModal('{{ route('register') }}')"
                class="btn btn-primary btn-sm float-right">
                <i class="fas fa-plus-square"></i>
                Agregar
            </a>
            @endcan
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table id="usuariosActivos" class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Correo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>            
        </div>
    </div>
</div>
@endsection