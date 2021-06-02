<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*Route::redirect('/','/uz');
Route::group(['prefix' =>'{language}'],function (){*/
Route::match(['get','post'],'/', 'Client\AuthController@login')->name('login');
Route::group(['middleware' => 'web','auth:api'], function(){
Route::group(['namespace' => 'Client', 'middleware' => 'roleClient', 'prefix' => 'client'],function(){
    Route::resource('ticks', 'Client\TicketController');
    Route::get('faqclient','Client\FaqController@index')->name('faqclient');
    Route::get('faqclient/{id}','Client\FaqController@show')->name('faqclient.show');
    Route::post('comments', 'Client\CommentController@store')->name('comments.store');
});
Route::group(['namespace' => 'Client\Programmer', 'middleware' => 'roleProgrammer', 'prefix' => 'programmer'],function(){
    Route::resource('tickets', 'TicketController');
    Route::post('comm', 'CommentController@store')->name('comm.store');
});
Route::group(['namespace' => 'Client\Admin', 'middleware' => 'role', 'prefix' => 'admin'],function(){
    Route::get('home','HomeController@index')->name('home');
    Route::resource('users', 'UserController');
    Route::resource('announcement', 'AnnouncementController');
    Route::resource('categories', 'CategoryController');
    Route::resource('projects', 'ProjectController');
    Route::resource('faq', 'FaqController');
    Route::resource('ticket','TicketController');
    Route::post('ticket/{id}', 'CommentController@create')->name('comment.create');
    Route::post('ticket/{id}/close','TicketController@closeTicket')->name('ticket.close');
});
Route::group(['namespace' => 'Client\Support', 'prefix' => 'support'], function (){
    Route::resource('ticks2', 'TicketController')->except('show','create','store');
    Route::get('ticks2/{ticket}','TicketController@tickets')->name('ticks2.ticket');
    Route::get('ticksShow/{id}','TicketController@show')->name('ticks2.show');
    Route::match('get','ticks2/{projectId}/create','TicketController@create')->name('ticks2.create');
    Route::match('post','ticks2/{projectId}/store','TicketController@store')->name('ticks2.store');
});
});
Route::match(['get','post'],'logout','Client\AuthController@logout')->name('logout');
/*});*/


