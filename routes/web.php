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

Route::get('/', 'PageController@welcome')->name('welcome');

Auth::routes();

// Route::post('/home', 'PageController@action');
// Route::post('/album/new/{name}', 'AlbumController@')

Route::get('/home', 'PageController@home')->name('home');

Route::get('/album/{id}/', 'AlbumController@show')->name('album');
Route::post('/album/{id}/', 'AlbumController@action');
Route::put('/album/{id}/title', 'AlbumController@editTitle');

Route::put('/image/{id}/title', 'ImageController@editTitle');
Route::post('/image/{id}', 'ImageController@action');

Route::post('/upload/{album}', 'ImageController@upload')->name('upload');

Route::post('/upload/album/new', 'AlbumController@new');
Route::post('/upload/album/{id}', 'AlbumController@upload');


Route::get('/download/image/{file}', 'ImageController@getFile');





Route::fallback('PageController@default');