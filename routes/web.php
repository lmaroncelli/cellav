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
		
		Route::get('/pannello', ['as' => 'pannello', 'uses' => 'Admin\AdminController@index']);
  
		Route::get('admin/users/{user}/confirm', ['as' => 'users.confirm', 'uses' => 'Admin\UsersController@confirm']);

		Route::resource('admin/users', 'Admin\UsersController');


		Route::get('admin/pages/{page}/confirm', ['as' => 'pages.confirm', 'uses' => 'Admin\PagesController@confirm']);
		Route::post('admin/pages/uri_ajax', ['as' => 'pages.uri_ajax', 'uses' => 'Admin\PagesController@createUri']);

		Route::resource('admin/pages', 'Admin\PagesController');

		Route::get('admin/prodotti/{prodotto}/confirm', ['as' => 'prodotti.confirm', 'uses' => 'Admin\ProdottiController@confirm']);
		Route::resource('admin/prodotti', 'Admin\ProdottiController');

		Route::get('admin/ricette/{ricetta}/confirm', ['as' => 'ricette.confirm', 'uses' => 'Admin\RicetteController@confirm']);
		Route::resource('admin/ricette', 'Admin\RicetteController');

		Route::get('admin/categorie-ricette/{categoria}/confirm', ['as' => 'categorie-ricette.confirm', 'uses' => 'Admin\CategorieRicetteController@confirm']);
		Route::resource('admin/categorie-ricette', 'Admin\CategorieRicetteController');


		
		Route::get('admin/gallery/carica/{id}', ['as' => 'gallerie.carica', 'uses' => 'Admin\GallerieController@carica']);
		Route::post('admin/gallery/uploadFile', ['as' => 'gallerie.upload', 'uses' => 'Admin\GallerieController@uploadFile']);
		Route::get('admin/gallerie/{galleria}/confirm', ['as' => 'gallerie.confirm', 'uses' => 'Admin\GallerieController@confirm']);
		Route::resource('admin/gallerie', 'Admin\GallerieController');



		Route::resource('admin/articoli', 'Admin\ArticoliController');
		Route::resource('admin/categorie-articoli', 'Admin\CategorieArticoliController');




		/* HOME PAGE */

		Route::get('admin/homepage', ['as' => 'homepage.edit', 'uses' => 'Admin\HomePageController@edit']);
		Route::post('admin/homepage', ['as' => 'homepage.save', 'uses' => 'Admin\HomePageController@update']);

		Route::post('admin/homepage/uploadSlideHeader', ['as' => 'homepage.uploaduploadSlideHeader', 'uses' => 'Admin\HomePageController@uploadSlideHeader']);
		



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




////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////// //
// route to access images Laravel 5 - How to access image uploaded in storage within View? // //
///////////////////////////////////////////////////////////////////////////////////////////// //
// How to define a Laravel route with a parameter that contains a slash character             //
////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('images/{filename_witslash}', function ($filename_witslash)
{	

    $path = storage_path() . '/app/' . $filename_witslash;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;

})->where('filename_witslash', '(.*)');


//////////////////
// ROUTE LIBERA //
//////////////////

Route::get('/{slug?}', 'SiteController@make')/*->middleware('beforeDBQuery','afterDBQuery')*/;
Route::get('/categoria/{slug?}', 'SiteController@makeCategoria')/*->middleware('beforeDBQuery','afterDBQuery')*/;


//////////
// blog //
//////////

Route::get('blog/show/{id}', array('as' => 'blog/show', 'uses' => 'BlogController@show'));

Route::get('blog/{query_id?}/{s_cat_id?}', array('as' => 'blog', 'uses' => 'BlogController@index'));
