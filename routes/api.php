<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', 'Api\AuthController@login');
Route::get('logout', 'Api\AuthController@logout');
Route::group([/*'middleware' => 'auth:api', */'namespace' => 'Api\Client', 'prefix' => 'client'], function(){
    Route::get('test', 'TestController@test');
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
   Route::get('logout', 'Api\AuthController@logout');
});
