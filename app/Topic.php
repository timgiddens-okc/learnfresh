<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
		protected $fillable = ['title','user_id','category'];
	
    public function user()
    {
    		return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
    		return $this->hasMany(Comment::class);
    }
    
    public function addComment(Comment $comment)
    {
    		$comment->topic_id = $this->id;
    		
    		$this->comments()->save($comment);
    }
}
