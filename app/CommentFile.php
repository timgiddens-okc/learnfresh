<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentFile extends Model
{
    protected $guarded = ['id'];
    
    public function comment()
    {
	    return $this->belongsTo(Comment::class);
    }
}
