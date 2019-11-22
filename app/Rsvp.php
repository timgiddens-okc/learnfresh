<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
		protected $fillable = ['event_id','user_id', 'students', 'additional_guests', 'school_program_name','name','email','phone','shirt_sizes'];
	
    public function event()
    {
	    return $this->belongsTo(Event::class);
    }
    
    public static function checkRsvp(Event $event)
    {
	    if(Rsvp::where([['event_id', '=', $event->id],['user_id', '=', \Auth::user()->id]])->count() > 0) {
		    return true;
	    }
	    return false;
    }
}
