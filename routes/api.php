<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'Api\AuthController@login');
Route::group(['middleware' => ['auth:api']], function() {
    Route::match(['get','post'],'logout', 'Api\AuthController@logout');

Route::group(['namespace' => 'Api\Client', 'prefix' => 'client'], function(){
    Route::apiResource('ticks', 'TicketController');
    Route::get('faqclient','FaqController@index');
    Route::get('logout', 'Api\AuthController@logout');
});

Route::group(['namespace' => 'Api\Admin', 'prefix' => 'admin'], function(){
   Route::apiResource('users', 'UserController');
   Route::apiResource('projects', 'ProjectController');
   Route::apiResource('categories', 'CategoryController');
   Route::apiResource('faq', 'FaqController');
   Route::apiResource('ticket','TicketController');
   Route::apiResource('home','HomeController');
   Route::get('logout', 'Api\AuthController@logout');
});
Route::group(['namespace' => 'Api\Programmer', 'prefix' => 'programmer'], function(){
   Route::apiResource('tickets', 'TicketController');
   Route::get('tickets/{id}/edit', 'TicketController@edit');
   Route::get('logout', 'Api\AuthController@logout');
});
});
