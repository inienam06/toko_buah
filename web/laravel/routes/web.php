<?php

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

Route::get('/', 'TemplateController@index')->name('template');

Route::post('masuk', 'LoginController@masuk')->name('masuk');
Route::get('keluar', 'LoginController@keluar')->name('keluar');

Route::get('produk/{title}', 'ProdukController@produk_detail')->name('produk_detail');
Route::get('kategori/{title}', 'KategoriController@index')->name('kategori');

Route::group(['middleware' => 'is_user'], function(){
	Route::group(['prefix' => 'pesanan'], function(){
		Route::get('/', 'TemplateController@pesanan')->name('pesanan');
	});
});


//DASHBOARD
Route::group(['prefix' => 'dashboard'], function() {
	Route::get('masuk', 'Dashboard\LoginController@formLogin')->name('dashboard.masuk');
	Route::post('masuk', 'Dashboard\LoginController@masuk')->name('dashboard.masuk.auth');

	Route::group(['prefix' => '/', 'middleware' => 'is_admin'], function() {
		Route::get('keluar', 'Dashboard\LoginController@keluar')->name('dashboard.keluar');

		Route::get('/', 'Dashboard\IndexController@index')->name('dashboard');

		//PROFILE
		Route::get('profil', 'Dashboard\IndexController@profil')->name('dashboard.profil');
		Route::post('profil/simpan', 'Dashboard\ProfilController@profil')->name('dashboard.profil.simpan');

		Route::get('ubah-password', 'Dashboard\IndexController@ubah_password')->name('dashboard.ubah_password');
		Route::post('ubah-password/simpan', 'Dashboard\ProfilController@ubah_password')->name('dashboard.ubah_password.simpan');

		//KATEGORI
		Route::group(['prefix' => 'kategori'], function(){
			Route::get('/', 'Dashboard\IndexController@kategori')->name('dashboard.kategori');
			Route::get('datatable', 'Dashboard\KategoriController@datatable')->name('dashboard.kategori.datatable');

			Route::get('tambah', 'Dashboard\KategoriController@tambah')->name('dashboard.kategori.tambah');
			Route::post('simpan', 'Dashboard\KategoriController@simpan')->name('dashboard.kategori.simpan');

			Route::get('ubah/{id}', 'Dashboard\KategoriController@ubah')->name('dashboard.kategori.ubah');
			Route::post('perbarui/{id}', 'Dashboard\KategoriController@perbarui')->name('dashboard.kategori.perbarui');

			Route::get('hapus/{id}', 'Dashboard\KategoriController@hapus')->name('dashboard.kategori.hapus');
		});

		//PRODUK
		Route::group(['prefix' => 'produk'], function(){
			Route::get('/', 'Dashboard\IndexController@produk')->name('dashboard.produk');
			Route::get('datatable', 'Dashboard\ProdukController@datatable')->name('dashboard.produk.datatable');

			Route::get('tambah', 'Dashboard\ProdukController@tambah')->name('dashboard.produk.tambah');
			Route::post('simpan', 'Dashboard\ProdukController@simpan')->name('dashboard.produk.simpan');

			Route::get('ubah/{slug}', 'Dashboard\ProdukController@ubah')->name('dashboard.produk.ubah');
			Route::post('perbarui/{slug}', 'Dashboard\ProdukController@perbarui')->name('dashboard.produk.perbarui');

			Route::get('hapus/{slug}', 'Dashboard\ProdukController@hapus')->name('dashboard.produk.hapus');
		});

		//PESANAN
		Route::group(['prefix' => 'pesanan'], function(){
			Route::get('/', function(){
				return redirect()->route('dashboard.pesanan.baru');
			});

			Route::group(['prefix' => 'baru'], function(){
				Route::get('/', 'Dashboard\IndexController@pesanan_baru')->name('dashboard.pesanan.baru');
				Route::get('datatable', 'Dashboard\PesananController@datatable_baru')->name('dashboard.pesanan.baru.datatable');
			});

			Route::group(['prefix' => 'sedang-diantar'], function(){
				Route::get('/', 'Dashboard\IndexController@pesanan_diantar')->name('dashboard.pesanan.diantar');
				Route::get('datatable', 'Dashboard\PesananController@datatable_diantar')->name('dashboard.pesanan.diantar.datatable');
			});
		});
	});
});
