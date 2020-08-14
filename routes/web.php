<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/wyloguj', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Movies
Route::get('/filmy', 'MoviesController@index')->name('movies.index');
Route::get('/film/{movie}/{slug?}', 'MoviesController@show')->name('movies.show');
Route::get('/dodaj-film', 'MoviesController@create')->name('movies.create')->middleware('auth');
Route::get('/film/{movie}/{slug?}/edit', 'MoviesController@edit');
Route::post('/filmy', 'MoviesController@store')->name('movies.store');
Route::put('/film/{movie}', 'MoviesController@update');

// Series
Route::get('/seriale', 'SeriesController@index')->name('series.index');
Route::get('/serial/{serie}', 'SeriesController@show')->name('series.show');

// Crawlers
Route::get('/crawlers', 'CrawlersController@index')->name('crawlers.index');
Route::post('/crawlers', 'CrawlersController@add')->name('crawlers.add');

Route::post('/import', 'MoviesController@import')->name('import');

Route::get('/regulamin', function(){
    return view('pages.rules');
});

Route::get('/test', function(){

});