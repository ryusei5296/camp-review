<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  
  
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function likes()
    {
      return $this->hasMany(Like::class, 'review_id');
    }
    
    public function is_liked_by_auth_user()
      {
        $id = \Auth::id();
        $likers = array();
        foreach($this->likes as $like) {
          array_push($likers, $like->user_id);
        }
    
        if (in_array($id, $likers)) {
          return true;
        } else {
          return false;
        }
      }
}
