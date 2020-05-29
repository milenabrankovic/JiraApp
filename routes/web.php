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
Route::get('/', 'FrontendController@dashboard')->name('dashboard');
Route::get('/dashboard', 'FrontendController@dashboard')->name('dashboard');


  Route::get('/projects', 'FrontendController@projects_crud')->name('projects_crud');
  Route::get('/configuration', 'FrontendController@configuration')->name('configuration');
  Route::get('/users', 'FrontendController@users_crud')->name('users_crud');

  Route::get('/user_projects', 'FrontendController@user_projects');
  Route::get('/tasks', 'FrontendController@tasks');
  Route::get('/login', 'FrontendController@login')->name('login');
  Route::get('/error', 'FrontendController@error')->name('error');


  Route::post('auth/login', 'AuthController@login')->name('login');
  Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');
  });
  Route::group(['middleware' => 'jwt.refresh'], function(){
    Route::get('auth/refresh', 'AuthController@refresh');
  });

  Route::get('/activateSprint', 'Admin\ConfController@activateSprint');
  Route::get('/test', 'FrontendController@test');
