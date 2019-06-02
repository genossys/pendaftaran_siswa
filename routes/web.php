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

    Route::get('/admin', function () {
        return view('/admin/menuawal');
    })->name('admin');

    Route::get('/informasi', function () {
        return view('/admin/master/datainformasi');
    })->name('informasi');


    Route::get('/siswa', function () {
        return view('/admin/master/datasiswa');
    })->name('siswa');

});

Route::get('/home', 'HomeController@index')->name('home');
