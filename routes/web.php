<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'acl'], function () {
    //Routes for roles
    Route::get('roles', 'ACL\RoleController@index')
        ->name('role.index')
        ->middleware('permission:list roles');

    Route::get('role/create', 'ACL\RoleController@create')
        ->name('role.create')
        ->middleware('permission:create role');

    Route::post('role', 'ACL\RoleController@store')
        ->name('role.store')
        ->middleware('permission:create role');

    Route::get('role/{role}', 'ACL\RoleController@show')
        ->name('role.show')
        ->middleware('permission:show role');

    Route::get('role/{role}/edit', 'ACL\RoleController@edit')
        ->name('role.edit')
        ->middleware('permission:update role');

    Route::put('role/{role}', 'ACL\RoleController@update')
        ->name('role.update')
        ->middleware('permission:update role');
    //edn of routes for roles

    //Routes for permissions
    Route::get('permissions', 'ACL\PermissionController@index')
        ->name('permission.index')
        ->middleware('permission:list permissions');

    Route::get('permission/create', 'ACL\PermissionController@create')
        ->name('permission.create')
        ->middleware('permission:create permission');

    Route::post('permission', 'ACL\PermissionController@store')
        ->name('permission.store')
        ->middleware('permission:create create');

    Route::get('permission/{permission}', 'ACL\PermissionController@show')
        ->name('permission.show')
        ->middleware('permission:list permissions');
    //end of routes for permission
});

Route::get('task', "TaskController@index")
    ->name('task.index')
    ->middleware('permission:read tasks');
Route::get('task/create', "TaskController@create")
    ->name('task.create')
    ->middleware('permission:create task');
Route::post('task', "TaskController@store")
    ->name('task.store')
    ->middleware('permission:create task');
Route::get('task/{task}', "TaskController@show")
    ->name('task.show')
    ->middleware('permission:read tasks');
Route::get('task/{task}/edit', "TaskController@edit")
    ->name('task.edit')
    ->middleware('permission:update task');
Route::put('task/{task}', "TaskController@update")
    ->name('task.update')
    ->middleware('permission:update task');
Route::delete('task/{task}', "TaskController@destroy")
    ->name('task.destroy')
    ->middleware('permission:delete task');