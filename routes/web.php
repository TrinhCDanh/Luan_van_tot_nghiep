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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'GiangvienAuth', 'prefix' => 'giangvien'], function () {  
    Route::get('login', 'GiangvienAuthController@showLoginForm');
    Route::post('login', ['as' => 'giangvien.login','uses' => 'GiangvienAuthController@login']);
    Route::get('logout', ['as' => 'giangvien.logout','uses' => 'GiangvienAuthController@logout']);
});

Route::group(['namespace' => 'KythuatvienAuth', 'prefix' => 'kythuatvien'], function () {  
    Route::get('login', 'KythuatvienAuthController@showLoginForm');
    Route::post('login', ['as' => 'kythuatvien.login','uses' => 'KythuatvienAuthController@login']);
    Route::get('logout', ['as' => 'kythuatvien.logout','uses' => 'KythuatvienAuthController@logout']);
});


Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {
	// Route::get('home-admin', function() {
	// 	return view('home-admin');
	// });
	// Route::get('/', function() { return view('home-admin'); });
	// Route::get('/hocky', function() { return view('home-admin'); });
	Route::get('/{path}', function() { return view('home-admin'); })->where('path', '(.*)');
});

Route::group(['middleware' => 'giangvien_auth', 'prefix' => 'giangvien', 'as' => 'giangvien.'], function () {
	// Route::get('home-giangvien', function() {
	// 	return view('home-giangvien');
	// });
	Route::get('/{path}', function() { return view('home-giangvien'); })->where('path', '(.*)');
});

Route::group(['middleware' => 'kythuatvien_auth', 'prefix' => 'kythuatvien', 'as' => 'kythuatvien.'], function () {
	Route::get('home-kythuatvien', function() {
		return view('home-kythuatvien');
	});
});