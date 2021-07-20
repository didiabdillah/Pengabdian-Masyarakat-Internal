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

        //ADMIN
        Route::group(['middleware' => ['is_Admin']], function () {
            Route::group(['prefix' => 'admin'], function () {
                //Home
                Route::group(['prefix' => '/home'], function () {
                    Route::get('/', 'Admin\HomeController@index')->name('admin_home');
                });

                //Pengabdian
                Route::group(['prefix' => 'pengabdian'], function () {
                    Route::group(['prefix' => 'usulan'], function () {
                        Route::get('/', 'Admin\PengabdianController@usulan_pengabdian')->name('admin_pengabdian_usulan');
                    });

                    Route::group(['prefix' => 'pelaksanaan'], function () {
                        Route::get('/', 'Admin\PengabdianController@pelaksanaan_pengabdian')->name('admin_pengabdian_pelaksanaan');
                        Route::patch('/', 'Admin\PengabdianController@pelaksanaan_pengabdian_update')->name('admin_pengabdian_pelaksanaan_update');

                        Route::group(['prefix' => 'penilaian'], function () {
                            Route::get('/', 'Admin\PengabdianController@pelaksanaan_penilaian')->name('admin_penilaian_pelaksanaan');
                            Route::patch('/', 'Admin\PengabdianController@pelaksanaan_penilaian_update')->name('admin_penilaian_pelaksanaan_update');
                        });
                    });

                    // Route::get('/detail', 'Admin\PengabdianController@detail')->name('admin_pengabdian_detail');
                });

                //Jurusan
                Route::group(['prefix' => 'jurusan'], function () {
                    Route::get('/', 'Admin\JurusanController@index')->name('admin_jurusan');
                    Route::get('/insert', 'Admin\JurusanController@insert')->name('admin_jurusan_insert');
                    Route::post('/store', 'Admin\JurusanController@store')->name('admin_jurusan_store');
                    Route::get('/{id}/edit', 'Admin\JurusanController@edit')->name('admin_jurusan_edit');
                    Route::patch('/{id}/update', 'Admin\JurusanController@update')->name('admin_jurusan_update');
                    Route::delete('/{id}/destroy', 'Admin\JurusanController@destroy')->name('admin_jurusan_destroy');

                    // Program Studi
                    Route::group(['prefix' => '/{jurusan_id}/prodi'], function () {
                        Route::get('/', 'Admin\JurusanController@prodi_index')->name('admin_prodi');
                        Route::get('/insert', 'Admin\JurusanController@prodi_insert')->name('admin_prodi_insert');
                        Route::post('/store', 'Admin\JurusanController@prodi_store')->name('admin_prodi_store');
                        Route::get('/{id}/edit', 'Admin\JurusanController@prodi_edit')->name('admin_prodi_edit');
                        Route::patch('/{id}/update', 'Admin\JurusanController@prodi_update')->name('admin_prodi_update');
                        Route::delete('/{id}/destroy', 'Admin\JurusanController@prodi_destroy')->name('admin_prodi_destroy');
                    });
                });

                //Bidang
                Route::group(['prefix' => 'bidang'], function () {
                    Route::get('/', 'Admin\BidangController@index')->name('admin_bidang');
                    Route::get('/insert', 'Admin\BidangController@insert')->name('admin_bidang_insert');
                    Route::post('/store', 'Admin\BidangController@store')->name('admin_bidang_store');
                    Route::get('/{id}/edit', 'Admin\BidangController@edit')->name('admin_bidang_edit');
                    Route::patch('/{id}/update', 'Admin\BidangController@update')->name('admin_bidang_update');
                    Route::delete('/{id}/destroy', 'Admin\BidangController@destroy')->name('admin_bidang_destroy');
                });

                //Data Pendukung
                Route::group(['prefix' => 'data_pendukung'], function () {
                    Route::get('/', 'Admin\DataPendukungController@index')->name('admin_data_pendukung');
                });

                //Logbook
                Route::group(['prefix' => 'logbook'], function () {
                    Route::get('/', 'Admin\LogbookController@index')->name('admin_logbook');
                    // Route::get('/detail', 'Admin\LogbookController@detail')->name('admin_logbook_detail');
                });

                //Laporan Kemajuan
                Route::group(['prefix' => 'laporan_kemajuan'], function () {
                    Route::get('/', 'Admin\LaporanKemajuanController@index')->name('admin_laporan_kemajuan');
                });

                //Laporan Akhir
                Route::group(['prefix' => 'laporan_akhir'], function () {
                    Route::get('/', 'Admin\LaporanAkhirController@index')->name('admin_laporan_akhir');
                });

                //Reviewer
                Route::group(['prefix' => 'reviewer'], function () {
                    Route::group(['prefix' => 'daftar'], function () {
                        Route::get('/', 'Admin\ReviewerController@index')->name('admin_reviewer');
                        Route::get('/insert', 'Admin\ReviewerController@insert')->name('admin_reviewer_insert');
                        Route::post('/store', 'Admin\ReviewerController@store')->name('admin_reviewer_store');
                        Route::get('/edit/{id}', 'Admin\ReviewerController@edit')->name('admin_reviewer_edit');
                        Route::patch('/edit/{id}', 'Admin\ReviewerController@update')->name('admin_reviewer_update');
                        Route::delete('/destroy/{id}', 'Admin\ReviewerController@destroy')->name('admin_reviewer_destroy');
                    });

                    Route::group(['prefix' => 'plotting'], function () {
                        Route::get('/', 'Admin\PlottingReviewerController@index')->name('admin_plotting_reviewer');
                        Route::get('/{id}/give', 'Admin\PlottingReviewerController@give_reviewer')->name('admin_plotting_give_reviewer');
                        Route::patch('/{id}/give', 'Admin\PlottingReviewerController@give_reviewer_update')->name('admin_plotting_give_reviewer_update');
                    });
                });

                //Pengusul
                Route::group(['prefix' => 'pengusul'], function () {
                    Route::get('/', 'Admin\PengusulController@index')->name('admin_pengusul');
                    Route::get('/insert', 'Admin\PengusulController@insert')->name('admin_pengusul_insert');
                    Route::post('/store', 'Admin\PengusulController@store')->name('admin_pengusul_store');
                    Route::get('/edit/{id}', 'Admin\PengusulController@edit')->name('admin_pengusul_edit');
                    Route::patch('/edit/{id}', 'Admin\PengusulController@update')->name('admin_pengusul_update');
                    Route::delete('/destroy/{id}', 'Admin\PengusulController@destroy')->name('admin_pengusul_destroy');
                });
            });
        });
        // END ADMIN

        //REVIEWER
        Route::group(['middleware' => ['is_Reviewer']], function () {
            Route::group(['prefix' => 'reviewer'], function () {
                //Home
                Route::group(['prefix' => 'home'], function () {
                    Route::get('/', 'Reviewer\HomeController@index')->name('reviewer_home');
                });

                //Pengabdian
                Route::group(['prefix' => 'pengabdian'], function () {
                    Route::get('/', 'Reviewer\PengabdianController@index')->name('reviewer_pengabdian');

                    Route::group(['middleware' => ['is_Unlock_Nilai_Usulan']], function () {
                        Route::get('/{id}/detail', 'Reviewer\PengabdianController@detail')->name('reviewer_pengabdian_detail');
                        Route::get('/{id}/nilai', 'Reviewer\PengabdianController@nilai')->name('reviewer_pengabdian_nilai');
                        Route::patch('/{id}/nilai', 'Reviewer\PengabdianController@nilai_update')->name('reviewer_pengabdian_nilai_update');
                        Route::get('/{id}/nilai/ulasan', 'Reviewer\PengabdianController@nilai_ulasan')->name('reviewer_pengabdian_nilai_ulasan');
                        Route::patch('/{id}/nilai/ulasan', 'Reviewer\PengabdianController@nilai_ulasan_update')->name('reviewer_pengabdian_nilai_ulasan_update');

                        Route::get('/{id}/download/{file_name}/{file_category}', 'Reviewer\PengabdianController@file_download')->name('reviewer_pengabdian_file_download');
                        Route::get('/{id}/preview/{file_name}/{file_category}', 'Reviewer\PengabdianController@file_preview')->name('reviewer_pengabdian_file_preview');
                    });
                });

                //Biodata
                Route::group(['prefix' => 'biodata'], function () {
                    Route::get('/edit', 'Reviewer\BiodataController@edit')->name('reviewer_biodata_edit');
                    Route::patch('/update', 'Reviewer\BiodataController@update')->name('reviewer_biodata_update');
                    Route::patch('/update/picture', 'Reviewer\BiodataController@update_picture')->name('reviewer_biodata_update_picture');
                });
            });
        });
        // END REVIEWER

        //PENGUSUL
        Route::group(['middleware' => ['is_Pengusul']], function () {
            Route::group(['prefix' => 'pengusul'], function () {

                //Home
                Route::group(['prefix' => '/home'], function () {
                    Route::get('/', 'Pengusul\HomeController@index')->name('pengusul_home');
                });

                //Pengabdian
                Route::group(['prefix' => 'pengabdian'], function () {
                    Route::get('/', 'Pengusul\PengabdianController@index')->name('pengusul_pengabdian');
                    Route::get('/riwayat', 'Pengusul\PengabdianController@riwayat')->name('pengusul_pengabdian_riwayat');
                    // Route::get('/detail', 'Pengusul\PengabdianController@detail')->name('pengusul_pengabdian_detail');

                    Route::delete('/{id}/hapus', 'Pengusul\PengabdianController@hapus')->name('pengusul_pengabdian_hapus');

                    Route::group(['middleware' => ['is_Unlock_Tambah_Usulan']], function () {
                        Route::get('/tambah', 'Pengusul\PengabdianController@tambah')->name('pengusul_pengabdian_tambah');
                        Route::post('/tambah', 'Pengusul\PengabdianController@store')->name('pengusul_pengabdian_store');
                        Route::patch('/usulan/1/{id}', 'Pengusul\PengabdianController@update')->name('pengusul_pengabdian_update');
                        Route::get('/usulan/{page}/{id}', 'Pengusul\PengabdianController@usulan')->name('pengusul_pengabdian_usulan');

                        Route::get('/usulan/{id}/member/add', 'Pengusul\PengabdianController@tambah_anggota')->name('pengusul_pengabdian_tambah_anggota');
                        Route::post('/usulan/{id}/member/add', 'Pengusul\PengabdianController@store_anggota')->name('pengusul_pengabdian_store_anggota');
                        Route::delete('/usulan/{id}/member/remove/{removeid}', 'Pengusul\PengabdianController@remove_anggota')->name('pengusul_pengabdian_remove_anggota');

                        Route::post('/usulan/{id}/upload/dokumen', 'Pengusul\PengabdianController@upload_dokumen')->name('pengusul_pengabdian_upload_dokumen');

                        Route::post('/usulan/{id}/upload/rab', 'Pengusul\PengabdianController@upload_rab')->name('pengusul_pengabdian_upload_rab');

                        Route::get('/usulan/{id}/mitra/tambah', 'Pengusul\PengabdianController@tambah_mitra')->name('pengusul_pengabdian_tambah_mitra');
                        Route::post('/usulan/{id}/mitra/tambah', 'Pengusul\PengabdianController@store_tambah_mitra')->name('pengusul_pengabdian_store_tambah_mitra');
                        Route::get('/usulan/{id}/mitra/edit/{editid}', 'Pengusul\PengabdianController@edit_mitra')->name('pengusul_pengabdian_edit_mitra');
                        Route::patch('/usulan/{id}/mitra/edit/{editid}', 'Pengusul\PengabdianController@update_mitra')->name('pengusul_pengabdian_update_mitra');
                        Route::patch('/usulan/{id}/mitra/upload', 'Pengusul\PengabdianController@upload_dokumen_mitra')->name('pengusul_pengabdian_upload_dokumen_mitra');
                        Route::delete('/usulan/{id}/mitra/hapus/{removeid}', 'Pengusul\PengabdianController@hapus_mitra')->name('pengusul_pengabdian_hapus_mitra');

                        Route::post('/usulan/{id}/submit', 'Pengusul\PengabdianController@usulan_submit')->name('pengusul_pengabdian_submit');

                        Route::post('/usulan/mitra/get/kabupaten', 'Pengusul\PengabdianController@get_kabupaten')->name('pengusul_pengabdian_get_kabupaten');
                        Route::post('/usulan/mitra/get/kecamatan', 'Pengusul\PengabdianController@get_kecamatan')->name('pengusul_pengabdian_get_kecamatan');
                        Route::post('/usulan/mitra/get/desa', 'Pengusul\PengabdianController@get_desa')->name('pengusul_pengabdian_get_desa');

                        Route::get('usulan/{id}/download/{file_name}/{file_category}', 'Pengusul\PengabdianController@file_download')->name('pengusul_pengabdian_file_download');
                        Route::get('usulan/{id}/preview/{file_name}/{file_category}', 'Pengusul\PengabdianController@file_preview')->name('pengusul_pengabdian_file_preview');

                        Route::get('/usulan/{id}/luaran/{luaran_id}/edit', 'Pengusul\PengabdianController@edit_luaran')->name('pengusul_pengabdian_edit_luaran');
                        Route::patch('/usulan/{id}/luaran/{luaran_id}/edit', 'Pengusul\PengabdianController@update_luaran')->name('pengusul_pengabdian_update_luaran');
                        Route::delete('/usulan/{id}/luaran/{luaran_id}/delete', 'Pengusul\PengabdianController@destroy_luaran')->name('pengusul_pengabdian_destroy_luaran');
                        Route::get('/usulan/{id}/luaran/{tipe}/{urutan}', 'Pengusul\PengabdianController@tambah_luaran')->name('pengusul_pengabdian_tambah_luaran');
                        Route::post('/usulan/{id}/luaran/{tipe}/{urutan}', 'Pengusul\PengabdianController@store_luaran')->name('pengusul_pengabdian_store_luaran');
                    });
                });

                //Laporan Kemajuan
                Route::group(['prefix' => 'laporan_kemajuan'], function () {
                    Route::get('/', 'Pengusul\LaporanKemajuanController@index')->name('pengusul_laporan_kemajuan');
                    Route::get('/insert', 'Pengusul\LaporanKemajuanController@insert')->name('pengusul_laporan_kemajuan_insert');
                    Route::post('/store', 'Pengusul\LaporanKemajuanController@store')->name('pengusul_laporan_kemajuan_store');
                });

                //Laporan Akhir
                Route::group(['prefix' => 'laporan_akhir'], function () {
                    Route::get('/', 'Pengusul\LaporanAkhirController@index')->name('pengusul_laporan_akhir');
                    // Route::get('/insert', 'Pengusul\LaporanAkhirController@insert')->name('pengusul_laporan_akhir_insert');
                    Route::patch('/update', 'Pengusul\LaporanAkhirController@update')->name('pengusul_laporan_akhir_upload_update');
                });

                //Logbook
                Route::group(['prefix' => 'logbook'], function () {
                    Route::get('/', 'Pengusul\LogbookController@index')->name('pengusul_logbook');
                    // Route::get('/detail', 'Pengusul\LogbookController@detail')->name('pengusul_logbook_detail');
                    // Route::get('/insert', 'Pengusul\LogbookController@insert')->name('pengusul_logbook_insert');
                });

                //Biodata
                Route::group(['prefix' => '/biodata'], function () {
                    Route::get('/edit', 'Pengusul\BiodataController@edit')->name('pengusul_biodata_edit');
                    Route::patch('/update', 'Pengusul\BiodataController@update')->name('pengusul_biodata_update');
                    Route::patch('/update/picture', 'Pengusul\BiodataController@update_picture')->name('pengusul_biodata_update_picture');
                });
            });
        });
        // END PENGUSUL

        //Profile
        Route::group(['prefix' => 'u'], function () {
            Route::get('/{id}', 'ProfileController@index')->name('profile');
            Route::get('/{id}/setting', 'ProfileController@setting')->name('profile_setting');
            Route::patch('/{id}/setting', 'ProfileController@profile_update')->name('profile_setting_update');
            Route::put('/{id}/setting', 'ProfileController@password_update')->name('profile_setting_update_password');
            Route::patch('/{id}/setting/picture', 'ProfileController@picture_update')->name('profile_setting_update_picture');
        });

        //ERROR PAGE
        //403 Forbidden Page
        Route::get('/forbidden', 'ErrorController@forbidden')->name('forbidden');

        //404 Not Found Page
        Route::get('/notfound', 'ErrorController@not_found')->name('not_found');
        // END ERROR PAGE

        // FILE
        Route::group(['prefix' => 'file'], function () {
            Route::get('/{id}/download/{file_name}/{file_category}', 'FileController@file_download')->name('file_download');
            Route::get('/{id}/preview/{file_name}/{file_category}', 'FileController@file_preview')->name('file_preview');
        });
        // END FILE
    });
});
