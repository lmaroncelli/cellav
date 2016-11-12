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

		Route::get('admin/ricette/{ricetta}/confirm', ['as' => 'ricette.confirm', 'uses' => 'Admin\RicetteController@confirm']);
		Route::resource('admin/ricette', 'Admin\RicetteController');


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

Route::get('checkout', ['as' => 'checkout', 'uses' => 'Admin\CarrelloController@getCheckout']);
Route::post('checkout', ['as' => 'checkout', 'uses' => 'Admin\CarrelloController@postCheckout']);


Route::get('user-profile', ['as' => 'user.profile', 'uses' => 'Admin\UsersController@showProfile'])/*->middleware('beforeDBQuery','afterDBQuery')*/;




/////////////////////////////////////////////////////////////////////////////////////////////
// route to access images Laravel 5 - How to access image uploaded in storage within View? //
/////////////////////////////////////////////////////////////////////////////////////////////

Route::get('images/{filename}', function ($filename)
{	

    $path = storage_path() . '/app/' . $filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('images/{dir}/{filename}', function ($dir, $filename)
{	
		
    $path = storage_path() . '/app/' . $dir . '/' .$filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


//////////////////
// ROUTE LIBERA //
//////////////////
Route::get('/{slug?}', 'SiteController@make')/*->middleware('beforeDBQuery','afterDBQuery')*/;
