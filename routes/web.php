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



Auth::routes();


//Login
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('/admin/menuawal');
    });

    Route::prefix('pendaftaran')->group(function () {
        Route::get('/', 'Master\pendaftarControl@index')->name('dataPendaftar');
        Route::post('/simpanDataPendaftar', 'Master\pendaftarControl@insert')->name('simpanPendaftar');
        Route::get('/getDataPendaftar', 'Master\pendaftarControl@getDataPendaftar');
        Route::post('/gantiStatus', 'Master\pendaftarControl@updateStatus')->name('gantiStatus');
        Route::post('/editDataPendaftar', 'Master\pendaftarControl@update');
        Route::delete('/hapusDataPendaftar', 'Master\pendaftarControl@delete');
    });

    Route::prefix('laporan')->group(function () {
        Route::get('/', 'Master\pendaftarControl@laporan')->name('dataLaporanSiswa');
        Route::get('/getDataLaporanPendaftar', 'Master\pendaftarControl@getDataLaporanPendaftar');
    });

    Route::prefix('informasi')->group(function () {
        Route::get('/', 'Master\informasiControl@index')->name('informasi');
        Route::get('/getDataInformasi', 'Master\informasiControl@getDataInformasi');
        Route::post('/simpanDataInformasi', 'Master\informasiControl@insert')->name('simpanInformasi');
        Route::post('/editDataInformasi', 'Master\infromasiControl@update');
        Route::delete('/hapusDataInformasi', 'Master\informasiControl@delete');
    });

    Route::get('/admin', function () {
        return view('/admin/menuawal');
    })->name('admin');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cetakDataSiswa/{id}', 'pdfmaker@cetakDataSiswa')->name('cetakLapProduk');
Route::get('/cetakLapSiswa', 'pdfmaker@cetakLapSiswa');

Route::get('/tampilinformasi', 'Master\informasiControl@showInformasi');
Route::get('/apiPencarianPendaftar/{email}', 'Master\pendaftarControl@apiPencarianPendaftar');
Route::get('/apiDataPendaftar', 'Master\pendaftarControl@apiDataPendaftar');
Route::post('/apiSimpanPendaftaranAkun', 'Master\pendaftarControl@apiSimpanPendaftaranAkun');
Route::post('/apiSimpanPendaftaran', 'Master\pendaftarControl@apiSimpanPendaftaran');
Route::post('/apiUploadFoto', 'Master\pendaftarControl@apiUploadFoto');
Route::post('/apiLogin', 'Master\pendaftarControl@apiLogin');
Route::get('/profilsekolah', function () {
    return view('/umum/profilsekolah');
})->name('profilsekolah');

Route::get('/panduan', function () {
    return view('/umum/panduan');
})->name('panduan');
