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


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ROUTE ACCESSIBILI SOLO AL PROFILO ADMIN: oltre a dover essere loggato perché estende AdminController, è in un  //
// groupMiddleware che verifica se sono Admin                                                                     //
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['admin']], function () {
		
		Route::get('/pannello', 'Admin\AdminController@index');
  
		Route::get('admin/users/{user}/confirm', ['as' => 'users.confirm', 'uses' => 'Admin\UsersController@confirm']);

		Route::resource('admin/users', 'Admin\UsersController');


		Route::get('admin/pages/{page}/confirm', ['as' => 'pages.confirm', 'uses' => 'Admin\PagesController@confirm']);
		Route::post('admin/pages/uri_ajax', ['as' => 'pages.uri_ajax', 'uses' => 'Admin\PagesController@createUri']);

		Route::resource('admin/pages', 'Admin\PagesController');


		Route::get('admin/prodotti/{prodotto}/confirm', ['as' => 'prodotti.confirm', 'uses' => 'Admin\ProdottiController@confirm']);
		Route::resource('admin/prodotti', 'Admin\ProdottiController');

});

//////////////////////////////////////////////////
// fine ROUTE ACCESSIBILI SOLO AL PROFILO ADMIN	//
/////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////
// ROUTE ACCESSIBILE SOLO DA LOGGATO PERCHE' ESTENDE AdminController //
///////////////////////////////////////////////////////////////////////
Route::any('carrello/add/{prodotto_id}', ['as' => 'carrello.add', 'uses' => 'Admin\CarrelloController@addProdotto']);
Route::any('carrello/remove/{prodotto_id}', ['as' => 'carrello.remove', 'uses' => 'Admin\CarrelloController@removeProdotto']);

Route::get('carrello', ['as' => 'carrello.show', 'uses' => 'Admin\CarrelloController@showCarrello']);

Route::get('update-carrello-qty', ['as' => 'carrello.update-qty', 'uses' => 'Admin\CarrelloController@updateCarrelloQtyAjax']);



//////////////////
// ROUTE LIBERA //
//////////////////
Route::get('/{slug?}', 'SiteController@make')/*->middleware('beforeDBQuery','afterDBQuery')*/;


