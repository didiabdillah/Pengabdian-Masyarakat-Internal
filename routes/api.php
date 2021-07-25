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

Route::get('/index', 'API\ApiController@index');
Route::get('/{id}/show', 'API\ApiController@show');
Route::get('/create', 'API\ApiController@create');
Route::post('/store', 'API\ApiController@store');
Route::get('/{id}/edit', 'API\ApiController@edit');
Route::put('/{id}/update', 'API\ApiController@update');
Route::delete('/{id}/destroy', 'API\ApiController@destroy');
