<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::match(['get','post'],'/', 'Client\AuthController@login')->name('login');
Route::group(['middleware' => 'web'], function(){
Route::group(['namespace' => 'Client',/* 'middleware' => 'auth',*/ 'prefix' => 'client'],function(){
    Route::resource('tickets', 'Client\TicketController');
    Route::get('logout','AuthController@logout');
});
Route::group(['namespace' => 'Client\Programmer', /*'middleware' => 'auth',*/ 'prefix' => 'programmer'],function(){
    Route::resource('tickets', 'TicketController');
    //Route::get('logout','\App\Http\Controllers\Client\AuthController@logout');
});
Route::group(['namespace' => 'Client\Admin', /*'middleware' => 'auth',*/ 'prefix' => 'admin'],function(){
        Route::get('home','HomeController@index');
        Route::resource('users', 'UserController');
        Route::resource('categories', 'CategoryController');
        Route::resource('projects', 'ProjectController');
        Route::match(['get','post'],'logout','\App\Http\Controllers\Client\AuthController@logout');
});
});



