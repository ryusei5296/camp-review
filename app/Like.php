<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // 配列内の要素を書き込み可能にする
	protected $fillable = ['review_id','user_id'];
	
	public function review()
	{
	  return $this->belongsTo(Review::class);
	}
	
	public function user()
	{
	  return $this->belongsTo(User::class);
	}
}
