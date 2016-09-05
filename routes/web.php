<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', 'DashboardController@index');

Route::get('/dashboard/admin/user', 'UserController@index')->name('db.admin.user');
Route::get('/dashboard/admin/user/{id}', 'UserController@index');
Route::get('/dashboard/admin/user/create', 'UserController@create');
Route::post('/dashboard/admin/user/create', 'UserController@store');
Route::get('/dashboard/admin/user/edit/{id}', 'UserController@edit');
Route::patch('/dashboard/admin/user/edit/{id}', 'UserController@update');
Route::delete('/dashboard/admin/user/edit/{id}', 'UserController@delete');

Route::get('/dashboard/admin/roles', 'RolesController@index')->name('db.admin.roles');
Route::get('/dashboard/admin/roles/{id}', 'RolesController@index');
Route::get('/dashboard/admin/roles/create', 'RolesController@create');
Route::post('/dashboard/admin/roles/create', 'RolesController@store');
Route::get('/dashboard/admin/roles/edit/{id}', 'RolesController@edit');
Route::patch('/dashboard/admin/roles/edit/{id}', 'RolesController@update');
Route::delete('/dashboard/admin/roles/edit/{id}', 'RolesController@delete');

Route::get('/dashboard/admin/settings', 'SettingsController@index')->name('db.admin.settings');
Route::get('/dashboard/admin/settings/edit/{id}', 'SettingsController@edit');
Route::patch('/dashboard/admin/settings/edit/{id}', 'SettingsController@update');

