<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route﻿;


class AuthController extends Controller
{
    public function login(Request $request)
    {

        try{
            $request->request->add([
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $request->username,
                'password' => $request->password,
            ]);

            $tokenRequest = Request::create(config('services.passport.login_endpoint'),'post');

            $response = Route::dispatch($tokenRequest);

            return $response;

        } catch(\GuzzleHttp\Exception\BadResponseException $e){
            if($e->getCode() == 400){
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if($e->getCode() == 401){
                return response()->json('Your credentials are incorrect. Please try again.', $e->getCode());
            }
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }

    public function register(Request $request){
       $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

    }

    public function logout(){
        auth()->user()->tokens->each(function ($token) {
            $token->revoke();
        });
        return response()->json('Logged out succesfully', 200);
    }



}
