<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::match(['get','post'],'/', 'Client\Auth\AuthController@login')->name('login');
Route::group(['namespace' => 'Client'],function(){
    Route::get('test','TestController@test');
});
