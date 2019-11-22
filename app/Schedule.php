<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded = ['id'];
    
    public function days()
    {
	    return $this->hasMany(ScheduleDay::class);
    }
}
