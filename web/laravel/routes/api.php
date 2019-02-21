<?php
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
Route::group(['middleware' => 'hasApiKey'], function() {
    //Front End
    Route::get('beranda', 'Api\TemplateController@index');

    Route::group(['prefix' => 'user'], function(){
        Route::post('daftar', 'Api\AkunController@daftar');
        Route::post('masuk', 'Api\AkunController@masuk');
    });

    Route::get('kategori', 'Api\TemplateController@kategori');

    Route::get('produk/{title}', 'Api\ProdukController@produk_detail');
    Route::get('kategori/{title}', 'Api\KategoriController@detail');

    Route::group(['middleware' => 'hasAuthUser'], function(){
        Route::post('update-firebase', 'Api\AkunController@update_firebase');
        Route::post('get-code-confirmation', 'Api\AkunController@get_code_confirmation');
        
        Route::group(['prefix' => 'pesanan'], function(){
            Route::post('pesan', 'Api\PesananController@pesan');

            Route::get('semua/{id}', 'Api\PesananController@semua_pesanan');
            
            Route::get('{status}/{id}', 'Api\PesananController@pesanan_status');

            Route::get('{id}/{id_pesanan}', 'Api\PesananController@detail_pesanan');
        });
    });


    //DASHBOARD
    Route::group(['prefix' => 'admin'], function(){
        Route::post('daftar', 'Api\Dashboard\LoginRegisterController@daftar');
        Route::post('masuk', 'Api\Dashboard\LoginRegisterController@masuk');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'hasAuthAdmin'], function() {
        Route::group(['prefix' => 'profil/{id}'], function() {
            Route::get('/', 'Api\Dashboard\ProfilController@profil');
            Route::post('perbarui', 'Api\Dashboard\ProfilController@perbarui');

            Route::post('perbarui-password', 'Api\Dashboard\ProfilController@perbarui_password');
        });

        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/', 'Api\Dashboard\KategoriController@index');
            Route::post('simpan', 'Api\Dashboard\KategoriController@simpan');
            Route::get('ubah/{id}', 'Api\Dashboard\KategoriController@ubah');
            Route::post('perbarui/{id}', 'Api\Dashboard\KategoriController@perbarui');
            Route::get('hapus/{id}', 'Api\Dashboard\KategoriController@hapus');
        });

        Route::group(['prefix' => 'produk'], function () {
            Route::get('/', 'Api\Dashboard\ProdukController@index');
            Route::post('simpan', 'Api\Dashboard\ProdukController@simpan');
            Route::get('ubah/{judul}', 'Api\Dashboard\ProdukController@ubah');
            Route::post('perbarui/{judul}', 'Api\Dashboard\ProdukController@perbarui');
            Route::get('hapus/{judul}', 'Api\Dashboard\ProdukController@hapus');
        });

        Route::group(['prefix' => 'pesanan'], function(){
            Route::group(['prefix' => 'baru'], function(){
                Route::get('/', 'Api\Dashboard\PesananController@pesanan_baru');
                Route::get('antar/{id}', 'Api\Dashboard\PesananController@antar_pesanan');
            });

            Route::group(['prefix' => 'sedang-diantar'], function() {
                Route::get('/', 'Api\Dashboard\PesananController@pesanan_diantar');
                Route::get('telah-sampai/{id}', 'Api\Dashboard\PesananController@telah_sampai');
            });
        });
    });
});


