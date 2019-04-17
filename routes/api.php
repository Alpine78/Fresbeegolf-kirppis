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

// Kaikki hyväksytyt ilmoitukset
Route::get('advert', 'AdvertController@index');

// Moderoitavat ilmoitukset
Route::get('moderate', 'AdvertController@moderate');

// Yksi ilmoitus
Route::get('advert/{id}', 'AdvertController@show');

// Luo ilmoitus
Route::post('advert', 'AdvertController@store');

// Päivitä ilmoitus
Route::put('advert/{id}', 'AdvertController@update');

// Poista ilmoitus
Route::delete('advert/{id}', 'AdvertController@destroy');

///////////////////////////////////////

// Kaikki ilmoitukset
Route::get('ilmoitus', 'IlmoitusController@index');

// Moderoitavat ilmoitukset
Route::get('moderoi', 'IlmoitusController@moderate');

// Yksi ilmoitus
Route::get('ilmoitus/{id}', 'IlmoitusController@show');

// Luo ilmoitus
Route::post('ilmoitus', 'IlmoitusController@store');

// Päivitä ilmoitus
Route::put('muokkaa/{id}', 'IlmoitusController@update');

// Hyväksy ilmoitus
Route::put('hyvaksy/{id}', 'IlmoitusController@accept');

// Hylkää ilmoitus
Route::put('hylkaa/{id}', 'IlmoitusController@refuse');

// Poista ilmoitus
Route::delete('ilmoitus/{id}', 'IlmoitusController@destroy');

///////////////////////////////////////


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
