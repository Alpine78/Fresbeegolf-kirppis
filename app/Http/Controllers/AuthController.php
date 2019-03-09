<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
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
            'firstname' => ['required', 'string', 'min:3', 'max:255'],
            'lastname' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nickname' => ['required', 'string', 'min:5', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        return User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'nickname' => $request->nickname,
            'password' => Hash::make($request->password),
        ]);

    }

    public function logout(){
        auth()->user()->tokens->each(function ($token) {
            $token->revoke();
        });
        return response()->json('Logged out succesfully', 200);
    }

    public function updateUser(Request $request){
        if(Auth::check()){
            $user = Auth::user();


            $request->validate([
                'firstname' => ['required', 'string', 'min:3', 'max:255'],
                'lastname' => ['required', 'string', 'min:3', 'max:255'],
                'nickname' => ['required', 'string', 'min:5', 'max:255', Rule::unique('users')->ignore($user-> id)],
                'zipcode' => [ 'string', 'max:10', 'nullable'],
                'address' => [ 'string', 'max:255', 'nullable' ],
                'city' => [ 'string', 'max:255', 'nullable'],
                'phonenumber' => [ 'string', 'max:15', 'nullable'],
            ]);

            $user-> firstname = $request['firstname'];
            $user-> lastname = $request['lastname'];
            $user->nickname = $request['nickname'];
            $user->zipcode = $request['zipcode'];
            $user->address = $request['address'];
            $user->city = $request['city'];
            $user->phonenumber = $request['phonenumber'];

            $user->save();
            return response()->json('User updated succesfully', 200);
        }else{
            return response()->json('Not logged in', 400);
        }

    }


}
