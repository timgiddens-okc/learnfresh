<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScheduleDay extends Model
{
    protected $guarded = ['id'];
    
    public function schedule()
    {
	    return $this->belongsTo(Schedule::class);
    }
    
    public function items()
    {
	    return $this->hasMany(ScheduleItem::class);
    }
}
