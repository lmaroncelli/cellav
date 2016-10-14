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
    return view('admin.layouts.backend');
});


Auth::routes();




Route::get('/pannello', 'HomeController@index');


Route::get('admin/users/{user}/confirm', ['as' => 'users.confirm', 'uses' => 'Admin\UsersController@confirm']);
Route::resource('admin/users', 'Admin\UsersController');