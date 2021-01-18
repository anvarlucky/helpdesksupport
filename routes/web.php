<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::match(['get','post'],'/', 'Client\AuthController@login')->name('login');
Route::group(['middleware' => 'web'], function(){
Route::group(['namespace' => 'Client',/* 'middleware' => 'auth',*/ 'prefix' => 'client'],function(){
    Route::resource('tickets', 'Client\TicketController');
    Route::get('logout','AuthController@logout');
});
Route::group(['namespace' => 'Client\Programmer', /*'middleware' => 'auth',*/ 'prefix' => 'programmer'],function(){
    Route::resource('tick', 'TicketController');
    Route::get('logout','\App\Http\Controllers\Client\AuthController@logout');
});
Route::group(['namespace' => 'Client\Admin', /*'middleware' => 'auth',*/ 'prefix' => 'admin'],function(){
        Route::resource('users', 'UserController')->middleware(['web', 'auth']);
        Route::resource('categories', 'CategoryController');
        Route::resource('projects', 'ProjectController');
        Route::match(['get','post'],'logout','\App\Http\Controllers\Client\AuthController@logout');
});
});



