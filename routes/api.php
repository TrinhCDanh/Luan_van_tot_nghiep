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
Route::resource('/monhoc','MonhocController');
// Orther function
Route::get('/phongmay-have-may/{id}', 'PhongmayController@listMaybyPhongMay');
