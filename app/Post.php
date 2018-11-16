<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function categores()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /*relation for favoret*/

     public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
 
/* post publish condition ar jonno*/
      public function scopeApproved($query)
    {
        return $query->where('is_aproved', 1);
    }
     public function scopePublish($query)
    {
        return $query->where('statas', 1);
    }
}
