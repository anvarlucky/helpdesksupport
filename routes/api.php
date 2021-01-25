<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'Api\AuthController@login');
Route::get('logout', 'Api\AuthController@logout');
Route::group([/*'middleware' => 'auth:api', */'namespace' => 'Api\Client', 'prefix' => 'client'], function(){
    Route::apiResource('tickets', 'TicketController');
    Route::get('logout', 'Api\AuthController@logout');
});

Route::group([/*'middleware' => 'auth:api',*/ 'namespace' => 'Api\Admin', 'prefix' => 'admin'], function(){
   Route::apiResource('users', 'UserController');
   Route::apiResource('projects', 'ProjectController');
   Route::apiResource('categories', 'CategoryController');
    Route::get('logout', 'Api\AuthController@logout');

});
Route::group([/*'middleware' => 'auth:api', */'namespace' => 'Api\Programmer', 'prefix' => 'programmer'], function(){
   Route::apiResource('tickets', 'TicketController');
   Route::get('tickets/{id}/edit', 'TicketController@edit');
   Route::get('logout', 'Api\AuthController@logout');
});
