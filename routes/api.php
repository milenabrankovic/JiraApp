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

Route::group(['middleware' => 'auth:api'], function() {

    //admin
   // Route::group(['middleware' => 'auth.role'], function() {
        Route::resource('user', 'Admin\UserController');
        Route::resource('project', 'Admin\ProjectController');
        Route::get('team', 'Admin\UserController@team');
        Route::put('edit_team/{id}', 'Admin\UserController@edit_team');
        Route::get('check_parent', 'Admin\UserController@check_parent');
        Route::get('users_by_project', 'Admin\UserController@users_by_project');
        Route::post('info_update', 'Admin\ConfController@save');
        Route::post('assign_employee', 'Admin\ProjectController@assign_employee');
        Route::get('roles', 'Admin\UserController@roles')->name('user.roles');
        Route::get('team', 'Admin\UserController@team')->name('user.team');
        Route::get('projects_by_user', 'Admin\ProjectController@projects_by_user');
    //});
    
    //user
    Route::get('tasks_by_project', 'TaskController@tasks_by_project');
    Route::get('tasks_by_parent', 'TaskController@tasks_by_parent');
    Route::get('statuses', 'TaskController@statuses'); 
    Route::put('edit_status', 'TaskController@edit_status');
    Route::get('team_users', 'TaskController@team_users');
    Route::put('edit_task', 'TaskController@edit_task');
    Route::post('create_task', 'TaskController@create_task');
    Route::get('active_sprint', 'TaskController@active_sprint');
});


Route::get('info', 'Admin\ConfController@info');
Route::get('company', 'Admin\ConfController@company');
