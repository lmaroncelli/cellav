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



Auth::routes();


Route::get('/pannello', 'HomeController@index');


Route::get('admin/users/{user}/confirm', ['as' => 'users.confirm', 'uses' => 'Admin\UsersController@confirm']);

Route::resource('admin/users', 'Admin\UsersController');


Route::get('admin/pages/{page}/confirm', ['as' => 'pages.confirm', 'uses' => 'Admin\PagesController@confirm']);
Route::post('admin/pages/uri_ajax', ['as' => 'pages.uri_ajax', 'uses' => 'Admin\PagesController@createUri']);

Route::resource('admin/pages', 'Admin\PagesController');


Route::get('admin/prodotti/{prodotto}/confirm', ['as' => 'prodotti.confirm', 'uses' => 'Admin\ProdottiController@confirm']);
Route::resource('admin/prodotti', 'Admin\ProdottiController');


Route::get('/{slug?}', 'SiteController@make')/*->middleware('beforeDBQuery','afterDBQuery')*/;
