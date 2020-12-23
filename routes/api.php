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

Route::post('login', 'Api\Auth\AuthController@login');
Route::post('registration', 'Api\Auth\AuthController@registration');

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api\Client', 'prefix' => 'client'], function(){
    Route::get('test', 'TestController@test');
    Route::apiResource('tickets', 'TicketController');
    Route::get('logout', 'Auth\AuthController@logout');
});

Route::group([/*'middleware' => 'auth:api', */'namespace' => 'Api\Admin', 'prefix' => 'admin'], function(){
   Route::apiResource('users', 'UserController');
   Route::apiResource('projects', 'ProjectController');
   Route::apiResource('categories', 'CategoryController');

});
