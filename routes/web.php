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

Route::get('/', 'PageController@welcome')
	->name('welcome');

Auth::routes();

Route::get('/home', 'PageController@home')
	->name('home');
Route::post('/home', 'PageController@action');

Route::post('/upload', 'PageController@upload')
	->name('upload');

