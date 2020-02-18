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

Route::group(['middleware'=>'language'],function () {

	// Bienvenida
    Route::get('/', function () {
    	return view('welcome');
	});

    // Cambiar idioma
	Route::get('/lang/{locale}', function (\Illuminate\Http\Request $request, $locale) {
	    $request->session()->put('locale', $locale);
	    return back();
	});

	// Rutas de autenticacion
	Auth::routes();

	/* POSTS */

	// Home
	Route::get('/home', 'HomeController@index')->name('home');

	// Detalle Post
	Route::get('/post/{pk}', 'HomeController@detail')->where('pk', '[0-9]+')->name('detail');

	Route::group(['middleware' => ['permission:create_post']], function () {
		// Crear Post
		Route::get('/post/create', 'HomeController@create')->name('create');
		Route::post('/home', 'HomeController@store');
	});


	Route::group(['middleware' => ['permission:edit_post']], function () {	
		// Editar Post
		Route::get('/post/{pk}/edit', 'HomeController@edit')->name('edit');
		Route::post('/post/{pk}', 'HomeController@update');
	});

	Route::group(['middleware' => ['permission:delete_post']], function () {
		// Eliminar Post
		Route::get('/post/{pk}/delete', 'HomeController@delete');
	});

	/* COMENTARIOS */

	// Crear Comentario
	Route::post('/post/{pk}/comment', 'HomeController@commentate')->name('commentate');

	Route::group(['middleware' => ['permission:delete_comment']], function () {
		// Eliminar Comentario
		Route::get('/comment/{pk}/delete', 'HomeController@deleteComment');
	});

	/* USUARIOS */

	// Listar usuarios
	Route::get('/users/list', 'UserController@list')->name('users.list');

	// Detalle usuario
	Route::get('/users/{pk}', 'UserController@detail')->where('pk', '[0-9]+')->name('users.detail');

	/* TOPICS */

	// Listar topics
	Route::get('/topic/list', 'TopicController@list')->name('topic.list');

	// Detalle Topic
	Route::get('/topic/{pk}', 'TopicController@detail')->where('pk', '[0-9]+')->name('topic.detail');

	Route::group(['middleware' => ['permission:create_topic']], function () {
		// Crear Topic
		Route::get('/topic/create', 'TopicController@create')->name('topic.create');
		Route::post('/topic/list', 'TopicController@store');
	});

	Route::group(['middleware' => ['permission:edit_topic']], function () {
		// Editar Topic
		Route::get('/topic/{pk}/edit', 'TopicController@edit')->name('topic.edit');
		Route::post('/topic/{pk}', 'TopicController@update');
	});

	Route::group(['middleware' => ['permission:delete_topic']], function () {
		// Eliminar Topic
		Route::get('/topic/{pk}/delete', 'TopicController@delete');
	});
});