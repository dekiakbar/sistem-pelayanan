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

Route::get('/', function () {
    return view('admin.user.tambahUser');
});

Route::get('kades',function(){
	return view('superadmin');
})->middleware('role:Kepala Desa');

Route::get('admin',function(){
	return view('admin.dashboard');
})->middleware('role:Admin')->name('admin');

Route::get('user',function(){
	return view('user');
})->middleware('role:User');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => 'role:Admin','name' => 'admin'], function(){

    Route::resource('pengguna','UserController')->except(['show','edit']);
    Route::resource('spp', 'SppController')->except(['create','store']);
});
