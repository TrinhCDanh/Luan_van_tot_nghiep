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
Route::resource('/giangvien', 'GiangvienController');
Route::resource('/lichtruc', 'LichtrucController');
Route::resource('/tinhtrangmay', 'TinhtrangmayController');
Route::resource('/lichday', 'LichdayController');

// Orther api function
Route::get('ten-phongmay/{id}','MayController@getTenPhongMay');
Route::get('/lichtruc-hocky/{hocky_id}', 'LichtrucController@lichtrucHocky');
//Route::get('/lichtruc-hocky/{hocky_id}','LichtrucController@lichtrucHocky');
Route::get('/phongmay-have-may/{id}', 'PhongmayController@listMaybyPhongMay');
Route::get('/lichtruc-kythuatvien/{hocky_id}/{kythuatvien_current_id}', 'Kythuatvien\DashboardController@lichtrucHockyKTV');
Route::get('/tinhtrang-may-list/{may_slug}', 'TinhtrangmayController@listTinhtrangmay');
Route::get('/tinhtrangmay-loi', 'TinhtrangmayController@soMayLoi');
Route::post('/kythuatvien-edit-mycount/{id}', 'KythuatvienController@updateKythuatvien');
Route::post('/kythuatvien-upload-avatar/{id}', 'KythuatvienController@uploadAvatarKTV');
Route::get('/lichday-hocky-ca/{hocky}/{ca}', 'LichdayController@getHockyCaLichday');
Route::get('/hocky-tuanhoc/{hocky_id}', 'HockyController@tuanhoc');
Route::get('/lich-nghi-ngay-nghi/{hocky_id}', 'DangkynghiController@getNgayNghi');
Route::get('/lich-bu-ngay-bu/{hocky_id}', 'DangkybuController@getNgayBu');
// Route::group(['middleware' => 'kythuatvien_auth', 'prefix' => 'kythuatvien', 'as' => 'kythuatvien.'], function () {
//     //Route::get('/dashboard', 'Kythuatvien\DashboardController@index');
//     // Route::get('home-kythuatvien', function() {
//     //  return view('home-kythuatvien');
//     // });
//     Route::get('/lichtruc-kythuatvien', 'Kythuatvien\DashboardController@lichtrucHockyKTV');
// });
Route::get('/lichday-giangvien/{hocky_id}/{giangvien_current_id}', 'LichdayController@getLichdayGV');
Route::get('/lich-nghi-ngay-nghi/giangvien/{hocky_id}/{giangvien_current_id}', 'DangkynghiController@getNgayNghiGV');
Route::get('/lich-bu-ngay-bu/giangvien/{hocky_id}/{giangvien_current_id}', 'DangkybuController@getNgayBuGV');
