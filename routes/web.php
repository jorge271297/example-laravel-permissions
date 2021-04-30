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