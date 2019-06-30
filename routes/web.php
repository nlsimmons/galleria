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

Route::get('/etc/phpinfo', 'PageController@phpinfo');

Route::get('/', 'PageController@welcome')
	->name('welcome');

Auth::routes();

Route::get('/home', 'PageController@home')
	->name('home');
Route::post('/home', 'PageController@action');

Route::get('/album/{id}/', 'AlbumController@show')
	->name('album');
Route::post('/upload/{album}', 'PageController@upload')
	->name('upload');

Route::put('/image/{id}/title', 'ImageController@editTitle');
Route::get('/download/image/{file}', 'ImageController@getFile');

Route::put('/album/{id}/title', 'AlbumController@editTitle');


Route::fallback('PageController@default');