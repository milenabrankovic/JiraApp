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

Route::get('projects_by_user', 'Admin\ProjectController@projects_by_user');
Route::get('tasks_by_project', 'TaskController@tasks_by_project');
Route::get('tasks_by_parent', 'TaskController@tasks_by_parent');
Route::get('statuses', 'TaskController@statuses'); 
Route::put('edit_status', 'TaskController@edit_status');
Route::get('team_users', 'TaskController@team_users');
Route::put('edit_task', 'TaskController@edit_task');
Route::post('create_task', 'TaskController@create_task');
Route::get('active_sprint', 'TaskController@active_sprint');


