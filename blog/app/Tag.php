<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

     public function getCreatedAtAttribute($value)
    {
        $value = date('U', strtotime($value));
        return $value * 1000;
    }
 
    public function getUpdatedAtAttribute($value)
    {
        $value = date('U', strtotime($value));
        return $value * 1000;
    }
}