<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $roles = Role::orderby('id', 'DESC')->paginate(10);
        return view('ACL.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $role        = new Role();
        $permissions = Permission::all();
        return view('ACL.role.form', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request) {
        DB::beginTransaction();
        try {
            //Creacion de rol
            $rolecreated = Role::create([
                'name'       => $request->name,
                'guard_name' => 'web',
            ]);

            //Asignacion de permisos
            $rolecreated->givePermissionTo($request->permissions);

            DB::commit();
            return redirect()->route('role.index')->with('success','Rol actualizado Correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('role.index')->with('error','Ocurrio un error interno');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role) {
        return view('ACL.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role) {
        $permissions = Permission::all();
        return view('ACL.role.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role) {
        DB::beginTransaction();
        try {
            //actualisar nombre de rol
            $role->update(['name' => $request->name]);

            //ermover roles
            $role->getPermissionNames()->each(function ($item, $key) use ($role) {
                $role->revokePermissionTo($item);
            });

            //asignar roles
            $role->givePermissionTo($request->permissions);

            DB::commit();
            return redirect()->route('role.index')->with('success','Rol actualizado Correctamente');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('role.index')->with('error','Ocurrio un error interno');;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role) {
    }
}
