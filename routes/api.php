<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User;
use App\Http\Controllers\ChatController;
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

//Route Auth
Route::post('/register', 'App\Http\Controllers\RegisterController@register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/input','App\Http\Controllers\MonitoringController@datamasuk');
Route::get('/rudi','App\Http\Controllers\MonitoringController@rudi');
//Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

//Route User
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/logout', 'App\Http\Controllers\LogoutController@logout')->name('logout');
    Route::get('/monitoring','App\Http\Controllers\MonitoringController@all');
    Route::get('/monitoring/{id}','App\Http\Controllers\MonitoringController@show');
    Route::get('/userdevice','App\Http\Controllers\UserDeviceController@all');
    //Route::get('monitoring/{id}','App\Http\Controllers\MonitoringController@show');
    Route::get('/asik/{id}','App\Http\Controllers\MonitoringController@lala');
    Route::get('/setting','App\Http\Controllers\SettingController@all');
    //LIVE CHAT
    Route::post('/message','App\Http\Controllers\ChatController@store' );
    Route::get('/message','App\Http\Controllers\ChatController@all' );
    //COBA
    Route::get('/rudi', 'App\Http\Controllers\UserDeviceController@rudi');
    //REKAPDATA
    // Route::get('rekapdata', 'App\Http\Controllers\MonitoringController@rekapData');
        Route::middleware('is.admin')->group( function(){
        //Route::prefix('/admin')->group( function(){
            Route::get('/admin', 'App\Http\Controllers\UserController@showCurrentUser');
            //User
            Route::get('/dewi','App\Http\Controllers\UserController@ambil');
            Route::get('/jumlahuser','App\Http\Controllers\UserController@jumlahUser');
            Route::get('/user/{id}', 'App\Http\Controllers\UserController@show');
            Route::post('/user','App\Http\Controllers\UserController@store');
            Route::put('/user/{id}', 'App\Http\Controllers\UserController@update');
            Route::delete('/user/{id}', 'App\Http\Controllers\UserController@delete');
            //battery
            Route::get('/battery', 'App\Http\Controllers\BatteryController@all');
<<<<<<< Updated upstream
           // Route::get('/coba', 'App\Http\Controllers\BatteryController@getdata');
=======
            Route::get('/rudi', 'App\Http\Controllers\BatteryController@jumlahBattery');
            Route::get('/coba', 'App\Http\Controllers\BatteryController@getdata');
>>>>>>> Stashed changes
            Route::get('/battery/{id}', 'App\Http\Controllers\BatteryController@show');
            Route::post('/battery','App\Http\Controllers\BatteryController@store');
            Route::put('/battery/{id}', 'App\Http\Controllers\BatteryController@update');
            Route::delete('/battery/{id}', 'App\Http\Controllers\BatteryController@delete');
            //cell
            Route::get('/cell', 'App\Http\Controllers\CellController@all');
            Route::get('/cell/{id}', 'App\Http\Controllers\CellController@show');
            Route::post('/cell','App\Http\Controllers\CellController@store');
            Route::put('/cell/{id}', 'App\Http\Controllers\CellController@update');
            Route::delete('/cell/{id}', 'App\Http\Controllers\CellController@delete');
            //setting
            //Route::get('/setting','App\Http\Controllers\SettingController@all');
            Route::get('/setting/{id}','App\Http\Controllers\SettingController@show');
            Route::post('/setting','App\Http\Controllers\SettingController@store');
            Route::put('/setting/{id}','App\Http\Controllers\SettingController@update');
            Route::delete('/setting/{id}', 'App\Http\Controllers\SettingController@delete');
            //setting arus
            Route::get('/settingarus', 'App\Http\Controllers\SettingArusController@all');
            Route::get('/settingarus/{id}', 'App\Http\Controllers\SettingArusController@show');
            Route::post('/settingarus','App\Http\Controllers\SettingArusController@store');
            Route::put('/settingarus/{id}', 'App\Http\Controllers\SettingArusController@update');
            Route::delete('/settingarus/{id}', 'App\Http\Controllers\SettingArusController@delete');
            //setting suhu
            Route::get('/settingsuhu', 'App\Http\Controllers\SettingSuhuController@all');
            Route::get('/settingsuhu/{id}', 'App\Http\Controllers\SettingSuhuController@show');
            Route::post('/settingsuhu','App\Http\Controllers\SettingSuhuController@store');
            Route::put('/settingsuhu/{id}', 'App\Http\Controllers\SettingSuhuController@update');
            Route::delete('/settingsuhu/{id}', 'App\Http\Controllers\SettingSuhuController@delete');
            //setting tegangan
            Route::get('/settingtegangan', 'App\Http\Controllers\SettingTeganganController@all');
            Route::get('/settingtegangan/{id}', 'App\Http\Controllers\SettingTeganganController@show');
            Route::post('/settingtegangan','App\Http\Controllers\SettingTeganganController@store');
            Route::put('/settingtegangan/{id}', 'App\Http\Controllers\SettingTeganganController@update');
            Route::delete('/settingtegangan/{id}', 'App\Http\Controllers\SettingTeganganController@delete');
            //error
            Route::get('/erorrs', 'App\Http\Controllers\ErorrsController@all');
            Route::get('/erorrs/{id}', 'App\Http\Controllers\ErorrsController@show');
            Route::post('/erorrs','App\Http\Controllers\ErorrsController@store');
            Route::put('/erorrs/{id}', 'App\Http\Controllers\ErorrsController@update');
            Route::delete('/erorrs/{id}', 'App\Http\Controllers\ErorrsController@delete');
            //userdevice
            //Route::get('/userdevice','App\Http\Controllers\UserDeviceController@all');
            Route::get('/userdevice/{id}','App\Http\Controllers\UserDeviceController@kabeh');
            //Route::get('/userdevice/{id}','App\Http\Controllers\UserDeviceController@show');
            Route::post('/userdevice','App\Http\Controllers\UserDeviceController@store');
            Route::put('/userdevice/{id}','App\Http\Controllers\UserDeviceController@update');
            Route::delete('/userdevice/{id}', 'App\Http\Controllers\UserDeviceController@delete');
            //monitorings
            Route::put('monitoring/{id}','App\Http\Controllers\MonitoringController@update');
            Route::delete('monitoring/{id}','App\Http\Controllers\MonitoringController@delete');
        });
        Route::middleware('is.user')->group( function(){
            Route::get('/user', 'App\Http\Controllers\UserController@showCurrentUser');
        //Route::prefix('/user')->group( function(){
       });
});
