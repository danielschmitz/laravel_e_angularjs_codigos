<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo("App\User");
    }   

    public function comments(){
       return $this->hasMany('App\Comment');
   }

   public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
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