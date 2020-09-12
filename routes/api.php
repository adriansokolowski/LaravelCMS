<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('countries', 'Api\\CountryApiController');
Route::apiResource('categories', 'Api\\CategoryApiController');
Route::apiResource('movies', 'Api\\MovieApiController');

//Route::get('movies', 'Api\\MovieController@index');

// Admin panel
Route::group(['prefix' => 'admin', 'as' => 'api.', 'namespace' => 'Api\Admin'], function () {
    // Movies
    Route::apiResource('movies', 'MovieApiController');

    // Users
    Route::apiResource('users', 'UserApiController');
});
