<?php

use Illuminate\Http\Request;

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

Route::resource('/hocky', 'HockyController');
Route::resource('/thu', 'ThuController');
Route::resource('/ca', 'CaController');
Route::resource('/phongmay', 'PhongmayController');
Route::resource('/may', 'MayController');
Route::resource('/monhoc', 'MonhocController');
Route::resource('/lop', 'LopController');
Route::resource('/kythuatvien', 'KythuatvienController');
Route::resource('/lichtruc', 'LichtrucController');

// Orther function
Route::get('/phongmay-have-may/{id}', 'PhongmayController@listMaybyPhongMay');
Route::get('/lichtruc-hocky/{hocky_id}', 'LichtrucController@lichtrucHocky');
Route::get('/lichtruc-kythuatvien/{hocky_id}/{kythuatvien_current_id}', 'Kythuatvien\DashboardController@lichtrucHockyKTV');

// Route::group(['middleware' => 'kythuatvien_auth', 'prefix' => 'kythuatvien', 'as' => 'kythuatvien.'], function () {
//     //Route::get('/dashboard', 'Kythuatvien\DashboardController@index');
//     // Route::get('home-kythuatvien', function() {
//     //  return view('home-kythuatvien');
//     // });
//     Route::get('/lichtruc-kythuatvien', 'Kythuatvien\DashboardController@lichtrucHockyKTV');
// });
