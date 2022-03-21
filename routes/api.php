<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User;
use App\Helpers\ResponseFormatter;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});

//Route::group(['middleware -> auth:sanctum'], function(){
    //Route::get('/profile', function(Request $request){
   //    return auth()->user();
   // });
//});

Route::post('/register', 'App\Http\Controllers\RegisterController@register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/me', [AuthController::class, 'me']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

//Route User
Route::get('/user', 'App\Http\Controllers\UserController@all');
Route::get('/user/{id}', 'App\Http\Controllers\UserController@show');
Route::post('/user','App\Http\Controllers\UserController@store');
Route::put('/user/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/user/{id}', 'App\Http\Controllers\UserController@delete');

//Route BMS
Route::get('/battery', 'App\Http\Controllers\BatteryController@all');
Route::get('/battery/{id}', 'App\Http\Controllers\BatteryController@show');
Route::post('/battery','App\Http\Controllers\BatteryController@store');
Route::put('/battery/{id}', 'App\Http\Controllers\BatteryController@update');
Route::delete('/battery/{id}', 'App\Http\Controllers\BatteryController@delete');

//Route Erorr
Route::get('/erorrs', 'App\Http\Controllers\ErorrsController@all');
Route::get('/erorrs/{id}', 'App\Http\Controllers\ErorrsController@show');
Route::post('/erorrs','App\Http\Controllers\ErorrsController@store');
Route::put('/erorrs/{id}', 'App\Http\Controllers\ErorrsController@update');
Route::delete('/erorrs/{id}', 'App\Http\Controllers\ErorrsController@delete');

//Route Monitoring
//Route UserDevice
Route::get('/usdev','App\Http\Controllers\UserDeviceController@all');
//Route Setting
