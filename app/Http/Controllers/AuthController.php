<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use League\OAuth2\Server\Exception\OAuthServerException;
use mysql_xdevapi\Exception;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->request->add([
            'grant_type' => 'password',
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $tokenRequest = Request::create(config('services.passport.login_endpoint'), 'post');
        $response = Route::dispatch($tokenRequest);
        return $response;
    }

    public function register(Request $request){
       $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        return User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
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
