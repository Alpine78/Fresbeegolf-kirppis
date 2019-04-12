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

// Kaikki ilmoitukset
Route::get('ilmoitukset', 'AdvertController@index');

// Yksi ilmoitus
Route::get('ilmoitus/{id}', 'AdvertController@show');

// Luo ilmoitus
Route::post('ilmoitus', 'AdvertController@store');

// Päivitä ilmoitus
Route::put('ilmoitus', 'AdvertController@store');

// Poista ilmoitus
Route::delete('ilmoitus/{id}', 'AdvertController@destroy');


// Kaikki valokuvat
Route::get('valokuvat', 'PhotoController@index');

// Yhden ilmoituksen valokuvat
Route::get('valokuvat/{id}', 'PhotoController@advertphotos');


// Yksi valokuva
Route::get('valokuva/{id}', 'PhotoController@show');

// Luo valokuva
Route::post('valokuva', 'PhotoController@store');

// Päivitä valokuva
Route::put('valokuva', 'PhotoController@store');

// Poista valokuva
Route::delete('valokuva/{id}', 'PhotoController@destroy');
