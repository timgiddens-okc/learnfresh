<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    protected $guarded = ['id'];
    
    public function day()
    {
	    return $this->belongsTo(ScheduleDay::class);
    }
}
