<?php

use Illuminate\Http\Request;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//auth
Route::middleware('auth:api')->get('/userdata', 'AuthController@getUserData');
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::middleware('auth:api')->post('/updateUser', 'AuthController@updateUser');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');

//chat
Route::middleware('auth:api')->get('/messages', 'ChatController@fetchMessages');
Route::middleware('auth:api')->post('/sendMessage', 'ChatController@sendMessage');
Route::middleware('auth:api')->get('/conversations', 'ChatController@fetchConversations');
