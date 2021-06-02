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

//Logout
Route::get('/logout', 'AuthController@logout')->name('logout');

//AUTH PAGE (NOT LOGIN REQUIRED)
Route::group(['middleware' => ['prevent_Back_Button']], function () {
    Route::group(['middleware' => ['is_Not_Login']], function () {
        //Root Link -> Linked To Login
        Route::get('/', 'AuthController@login');

        //Login
        Route::get('/login', 'AuthController@login')->name('login');
        Route::post('/login', 'AuthController@login_process')->name('login_process');

        //Forgot Password
        Route::get('/forgot', 'AuthController@forgot_password')->name('forgot_password');
        Route::post('/forgot', 'AuthController@forgot_password_process')->name('forgot_password_process');

        //Change To New Password (Forgot Password)
        Route::get('/{email}/{token}/change', 'AuthController@change_password')->name('change_password');
        Route::post('/{email}/{token}/change', 'AuthController@change_password_process')->name('change_password_process');
    });
});

//USER PAGE (LOGIN REQUIRED)
Route::group(['middleware' => ['prevent_Back_Button']], function () {
    Route::group(['middleware' => ['is_Login']], function () {
        //Home
        Route::group(['prefix' => 'home'], function () {
            Route::get('/', 'HomeController@index')->name('home');
        });

        //ADMIN
        Route::group(['middleware' => ['is_Admin']], function () {
            Route::group(['prefix' => 'admin'], function () {
                //Pengabdian
                Route::group(['prefix' => 'pengabdian'], function () {
                    Route::get('/', 'PengabdianController@index')->name('pengabdian');
                });

                //Data Pendukung
                Route::group(['prefix' => 'data_pendukung'], function () {
                    Route::get('/', 'DataPendukungController@index')->name('data_pendukung');
                });

                //Logbook
                Route::group(['prefix' => 'logbook'], function () {
                    Route::get('/', 'LogbookController@index')->name('logbook');
                });

                //Laporan Kemajuan
                Route::group(['prefix' => 'laporan_kemajuan'], function () {
                    Route::get('/', 'LaporanKemajuanController@index')->name('laporan_kemajuan');
                });

                //Laporan Akhir
                Route::group(['prefix' => 'laporan_akhir'], function () {
                    Route::get('/', 'LaporanAkhirController@index')->name('laporan_akhir');
                });

                //Reviewer
                Route::group(['prefix' => 'reviewer'], function () {
                    Route::get('/', 'ReviewerController@index')->name('reviewer');
                    Route::get('/insert', 'ReviewerController@insert')->name('reviewer_insert');
                    Route::post('/store', 'ReviewerController@store')->name('reviewer_store');
                    Route::get('/edit/{id}', 'ReviewerController@edit')->name('reviewer_edit');
                    Route::patch('/edit/{id}', 'ReviewerController@update')->name('reviewer_update');
                    Route::delete('/destroy/{id}', 'ReviewerController@destroy')->name('reviewer_destroy');
                });

                //Pengusul
                Route::group(['prefix' => 'proposer'], function () {
                    Route::get('/', 'ProposerController@index')->name('proposer');
                    Route::get('/insert', 'ProposerController@insert')->name('proposer_insert');
                    Route::post('/store', 'ProposerController@store')->name('proposer_store');
                    Route::get('/edit/{id}', 'ProposerController@edit')->name('proposer_edit');
                    Route::patch('/edit/{id}', 'ProposerController@update')->name('proposer_update');
                    Route::delete('/destroy/{id}', 'ProposerController@destroy')->name('proposer_destroy');
                });
            });
        });

        //ADMIN
        Route::group(['middleware' => ['is_Admin']], function () {
            Route::group(['prefix' => 'admin'], function () {
                //Pengabdian
                Route::group(['prefix' => 'pengabdian'], function () {
                    Route::get('/', 'PengabdianController@index')->name('pengabdian');
                });

                //Data Pendukung
                Route::group(['prefix' => 'data_pendukung'], function () {
                    Route::get('/', 'DataPendukungController@index')->name('data_pendukung');
                });

                //Logbook
                Route::group(['prefix' => 'logbook'], function () {
                    Route::get('/', 'LogbookController@index')->name('logbook');
                });

                //Laporan Kemajuan
                Route::group(['prefix' => 'laporan_kemajuan'], function () {
                    Route::get('/', 'LaporanKemajuanController@index')->name('laporan_kemajuan');
                });

                //Laporan Akhir
                Route::group(['prefix' => 'laporan_akhir'], function () {
                    Route::get('/', 'LaporanAkhirController@index')->name('laporan_akhir');
                });

                //Reviewer
                Route::group(['prefix' => 'reviewer'], function () {
                    Route::get('/', 'ReviewerController@index')->name('reviewer');
                    Route::get('/insert', 'ReviewerController@insert')->name('reviewer_insert');
                    Route::post('/store', 'ReviewerController@store')->name('reviewer_store');
                    Route::get('/edit/{id}', 'ReviewerController@edit')->name('reviewer_edit');
                    Route::patch('/edit/{id}', 'ReviewerController@update')->name('reviewer_update');
                    Route::delete('/destroy/{id}', 'ReviewerController@destroy')->name('reviewer_destroy');
                });

                //Pengusul
                Route::group(['prefix' => 'proposer'], function () {
                    Route::get('/', 'ProposerController@index')->name('proposer');
                    Route::get('/insert', 'ProposerController@insert')->name('proposer_insert');
                    Route::post('/store', 'ProposerController@store')->name('proposer_store');
                    Route::get('/edit/{id}', 'ProposerController@edit')->name('proposer_edit');
                    Route::patch('/edit/{id}', 'ProposerController@update')->name('proposer_update');
                    Route::delete('/destroy/{id}', 'ProposerController@destroy')->name('proposer_destroy');
                });
            });
        });

        //PENGUSUL
        Route::group(['middleware' => ['is_Pengusul']], function () {
            Route::group(['prefix' => 'pengusul'], function () {
                //Pengabdian
                Route::group(['prefix' => 'pengabdian'], function () {
                    Route::get('/', 'Pengusul\PengabdianController@index')->name('pengusul_pengabdian');
                });

                //Laporan Kemajuan
                Route::group(['prefix' => 'laporan_kemajuan'], function () {
                    Route::get('/', 'LaporanKemajuanController@index')->name('pengusul_laporan_kemajuan');
                });

                //Laporan Akhir
                Route::group(['prefix' => 'laporan_akhir'], function () {
                    Route::get('/', 'LaporanAkhirController@index')->name('pengusul_laporan_akhir');
                });

                //Logbook
                Route::group(['prefix' => 'logbook'], function () {
                    Route::get('/', 'Pengusul\LogbookController@index')->name('pengusul_logbook');
                });
            });
        });

        //Profile
        Route::group(['prefix' => 'u'], function () {
            Route::get('/{id}', 'ProfileController@index')->name('profile');
            Route::get('/{id}/setting', 'ProfileController@setting')->name('profile_setting');
            Route::patch('/{id}/setting', 'ProfileController@profile_update')->name('profile_setting_update');
            Route::put('/{id}/setting', 'ProfileController@password_update')->name('profile_setting_update_password');
            Route::patch('/{id}/setting/picture', 'ProfileController@picture_update')->name('profile_setting_update_picture');
        });
    });
});
