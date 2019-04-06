<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    //
    protected $dates = ['deleted_at'];

    protected $fillable = ['content', 'user_2', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
