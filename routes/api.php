<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('project', 'Admin\ProjectController');
Route::resource('user', 'Admin\UserController');
Route::get('company', 'Admin\ConfController@company');
Route::get('info', 'Admin\ConfController@info');
Route::post('info_update', 'Admin\ConfController@save');
Route::post('assign_employee', 'Admin\ProjectController@assign_employee');
Route::get('roles', 'Admin\UserController@roles')->name('user.roles');


