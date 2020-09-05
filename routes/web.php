<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index');

Route::get('/wyloguj', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Movies
Route::get('/filmy', 'MovieController@index')->name('movies.index');
Route::get('/film/{movie}/{slug?}', 'MovieController@show')->name('movies.show');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dodaj-film', 'MovieController@create')->name('movies.create');
});

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

// Admin panel
Route::get('/admin/{any?}', function () {
    return view('admin.index');
})->where('any', '.*');
