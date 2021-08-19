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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => '{api_code}'], function () {
    Route::group(['middleware' => ['is_Api_Code']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/post/login', 'API\AuthController@post_login')->name('api_post_login');
            // Route::get('/{id}/show', 'API\ApiController@show');
            // Route::get('/create', 'API\ApiController@create');
            // Route::get('/{id}/edit', 'API\ApiController@edit');
            // Route::put('/{id}/update', 'API\ApiController@update');
            // Route::delete('/{id}/destroy', 'API\ApiController@destroy');
        });

        Route::group(['prefix' => 'pengabdian'], function () {
            Route::get('/{id}/get/pengabdian', 'API\PengabdianController@get_pengabdian');
        });

        Route::group(['prefix' => 'logbook'], function () {
            Route::get('/{id}/get/pengabdian', 'API\LogbookController@get_pengabdian');
            Route::post('/{id}/store', 'API\LogbookController@store');
            Route::post('/{id}/update', 'API\LogbookController@update');
            Route::post('/{id}/delete', 'API\LogbookController@delete');
        });

        Route::group(['prefix' => 'laporan_kemajuan'], function () {
            Route::get('/{id}/get/pengabdian', 'API\LaporanKemajuanController@get_pengabdian');
            Route::post('/{id}/store', 'API\LaporanKemajuanController@store');
            Route::post('/{id}/update', 'API\LaporanKemajuanController@update');
            Route::post('/{id}/delete', 'API\LaporanKemajuanController@delete');
        });

        Route::group(['prefix' => 'laporan_akhir'], function () {
            Route::get('/{id}/get/pengabdian', 'API\LaporanAkhirController@get_pengabdian');
            Route::post('/{id}/store', 'API\LaporanAkhirController@store');
            Route::post('/{id}/update', 'API\LaporanAkhirController@update');
            Route::post('/{id}/delete', 'API\LaporanAkhirController@delete');
        });

        Route::group(['prefix' => 'user'], function () {
        });

        Route::group(['prefix' => 'unlock'], function () {
        });
    });
});
