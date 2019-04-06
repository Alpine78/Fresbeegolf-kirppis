<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{

    protected $fillable = ['message'];
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
