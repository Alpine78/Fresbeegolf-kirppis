<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'nickname', 'email', 'address',  'zipcode',  'city', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function adverts() {
        return $this->hasMany('App\Advert');
    }

    public function ratings() {
        return $this->hasMany('App\Rating');
    }

    public function addresses() {
        return $this->hasMany('App\Address');
    }

    public function chats() {
        return $this->hasMany('App\Chat');
    }
}
