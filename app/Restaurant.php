<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //

    protected $fillable = [
        'name', 'address', 'contact', 'photo_id', 'user_id',
    ];

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('updated_at', 'desc');
    }
}
