<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index');

// Movies
Route::get('/filmy', 'MoviesController@index')->name('movies.index');
Route::get('/film/{movie}', 'MoviesController@show');
Route::get('/film/{movie}/edit', 'MoviesController@edit');
Route::put('/film/{movie}', 'MoviesController@update')->name('movies.show');
Route::get('/filmy/create', 'MoviesController@create');
Route::post('/filmy', 'MoviesController@store');

// Series
Route::get('/seriale', 'SeriesController@index')->name('series.index');

// Crawlers
Route::get('/fdb', function () {
    return view('crawlers/fdb');
});