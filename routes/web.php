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

Route::get('/projects', 'FrontendController@projects_crud')->name('projects_crud');
Route::get('/projects/assignment', 'FrontendController@projects_assignment')->name('projects_assignment');
Route::get('/configuration', 'FrontendController@configuration')->name('configuration');
Route::get('/users', 'FrontendController@users_crud')->name('users_crud');
