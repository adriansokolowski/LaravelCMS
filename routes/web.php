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
Route::get('/filmy', 'MovieController@index')->name('movies.index');
Route::get('/film/{movie}/{slug?}', 'MovieController@show')->name('movies.show');
Route::get('/dodaj-film', 'MovieController@create')->name('movies.create')->middleware('auth');
Route::get('/film/{movie}/{slug?}/edit', 'MovieController@edit');
Route::post('/filmy', 'MovieController@store')->name('movies.store');
Route::put('/film/{movie}', 'MovieController@update');

// Series
Route::get('/seriale', 'SerieController@index')->name('series.index');
Route::get('/serial/{serie}', 'SerieController@show')->name('series.show');

// Crawlers
Route::get('/crawlers', 'CrawlerController@index')->name('crawlers.index');
Route::post('/crawlers', 'CrawlerController@add')->name('crawlers.add');

Route::post('/import', 'MovieController@import')->name('import');


// Custom pages
Route::get('/regulamin', function(){
    return view('pages.rules');
});
Route::get('/pomoc', function(){
    return view('pages.help');
});
Route::get('/kontakt', function(){
    return view('pages.contact');
});

Route::get('/test', function(){

});