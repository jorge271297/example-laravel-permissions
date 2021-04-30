<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::all();
        $employees = Employee::All();
        return response()->json(view('auth.register', compact('roles', 'user', 'employees'))->render());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();

            try {
                //Registro de usuario
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'employee_id' => $request->employee_id,
                ]);

                //Asignacion de roles
                $user->assignRole($request->roles);

                DB::commit();

                return response()->json(\responseMessage(201, "El usuario se registro correctamente.", "success"));
            } catch (\Exception $e) {
                DB::rollback();

                return response()->json(\responseMessage(500, "Error interno:" . $e->getMessage(), "error"));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $employee = $user->employyes;
        return response()->json(view('auth._show', compact('user', 'employee'))->render());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $employees = Employee::all();
        return response()->json(view('auth.register', compact('roles', 'user', 'employees'))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if ($request->ajax()) {
            DB::beginTransaction();

            try {
                $user->update([
                    'email' => $request->email,
                    'employee_id' => $request->employee_id,
                ]);

                $rolesByUser = $user->getRoleNames()->toArray();
                if ($rolesByUser != "") {
                    for ($i = 0; $i < count($rolesByUser); $i++) {
                        $user->removeRole($rolesByUser[$i]);
                    }
                }

                $user->assignRole($request->roles);

                DB::commit();

                return response()->json(\responseMessage(201, "El usuario se actualizo correctamente.", "success"));
            } catch (\Exception $e) {
                DB::rollback();

                return response()->json(\responseMessage(500, "Error interno:" . $e->getMessage(), "error"));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editPassword(User $user)
    {
        return response()->json(view('auth.reset', compact('user'))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);

        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $user->update(['password' => Hash::make($request->password)]);
                DB::commit();

                return response()->json(\responseMessage(201, "Contraseña actualizada correctamente.", "success"));
            } catch (\Exception $e) {
                DB::rollback();

                return response()->json(\responseMessage(500, "Error interno:" . $e->getMessage(), "error"));
            }
        }
    }
}
