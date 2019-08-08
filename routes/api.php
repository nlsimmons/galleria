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

Route::middleware('auth:api')->group(function(){
	Route::get('/user', 'UserController@get');
	Route::get('/images/home', 'ImageController@home');
	Route::get('/images/album/{album_id}', 'ImageController@album');

	Route::get('/albums', 'AlbumController@get');
	Route::put('/albums/{id}/title', 'AlbumController@editTitle');

	Route::put('/images/{id}/title', 'ImageController@editTitle');

	Route::post('/images/upload', 'ImageController@upload');
	Route::post('/images/uploaddirect', 'ImageController@uploadDirect');
	Route::post('/images/confirm/{image}', 'ImageController@confirm');

	Route::delete('/images/{id}', 'ImageController@delete');
	Route::delete('/albums/{id}', 'AlbumController@delete');
});

Route::get('/images/welcome', 'ImageController@welcome');
