<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advert extends Model
{
    //
    use SoftDeletes;

    public function photos() {
        return $this->hasMany('App\Photo');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
