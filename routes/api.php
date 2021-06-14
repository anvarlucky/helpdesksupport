<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::apiResource('ticks1', 'Api\v1\Client\TicketController');
Route::get('ticketAll','Api\v1\Admin\TicketController@index')->name('tic');
Route::get('categoryAll','Api\v1\Admin\CategoryController@index')->name('cat');
Route::get('ticketProgrammer/{programmer_id}', 'Api\v1\Programmer\TicketController@tickets');
Route::get('ticketProgrammer/{programmer_id}', 'Api\v1\Programmer\TicketController@comments');
Route::post('login', 'Api\v1\AuthController@login');
Route::group(['middleware' => ['auth:api']], function() {
    Route::match(['get','post'],'logout', 'Api\v1\AuthController@logout');

Route::group(['namespace' => 'Api\v1\Client', 'prefix' => 'client'], function(){
    Route::apiResource('ticks', 'TicketController');
    Route::get('faqclient','FaqController@index');
    Route::get('faqclient/{id}','FaqController@show');
    Route::get('comments', 'CommentController@index');
    Route::get('logout', 'Api\AuthController@logout');
});

Route::group(['namespace' => 'Api\v1\Admin', 'prefix' => 'admin'], function(){
   Route::apiResource('users', 'UserController');
   Route::apiResource('announcements', 'AnnouncementController');
   Route::get('programmers', 'UserController@programmers');
   Route::apiResource('projects', 'ProjectController');
   Route::get('projectProgrammers','ProjectController@programmers')->name('programmers');
   Route::apiResource('categories', 'CategoryController');
   Route::apiResource('faq', 'FaqController');
   Route::apiResource('ticket','TicketController');
   Route::match(['get','post'],'ticket/{id}/comment','TicketController@comment')->name('ticket.comment');
   Route::match(['get','post'],'ticket/{id}/comment','CommentController@create')->name('comment');
   Route::apiResource('home','HomeController');
   Route::post('close/{id}','TicketController@closeTicket')->name('ticket.close');
   Route::get('logout', 'Api\AuthController@logout');
});
Route::group(['namespace' => 'Api\v1\Programmer', 'prefix' => 'programmer'], function(){
   Route::apiResource('tickets', 'TicketController');
   Route::get('tickets/{id}/edit', 'TicketController@edit');
   Route::get('logout', 'Api\AuthController@logout');
});
Route::group(['namespace' => 'Api\v1\Support', 'prefix' => 'support'], function(){
        Route::apiResource('ticks2', 'TicketController');
        Route::get('projects','TicketController@projects');
        Route::get('tickSup/{project_id}','TicketController@tickets');
    });
});
