<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'description', 'video_embed', 'file_location', 'resource_type', 'week_id','program_id','index'];
    
    public function weeks()
    {
	    return $this->belongsToMany(Week::class);
    }
    
    public function program()
    {
	    return $this->belongsTo(Program::class);
    }
}
