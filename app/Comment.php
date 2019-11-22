<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment','user_id', 'reply_id', 'topic_id'];
    
    public function topic()
    {
    		return $this->belongsTo(Topic::class);
    }
    
    public function user()
    {
    		return $this->belongsTo(User::class);
    }
    
    public function files()
    {
	    return $this->hasMany(CommentFile::class);
    }
    
    public function addFile(CommentFile $file)
    {
	    $this->files()->save($file);
    }
}
