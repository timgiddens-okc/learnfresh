<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title','location','event_date','details','parking_and_directions','rsvp','address','timezone','team','release_form','participation_certificate','video_embed','type','end_date','registration_cap','registration_open'];
    
    public function store(Request $request)
    {
    			
    }
    
    public function addImage(EventPhoto $eventPhoto)
    {
	    $this->images()->save($eventPhoto);
    }
    
    public function images()
    {
	    return $this->hasMany(EventPhoto::class);
    }
    
    public function rsvps()
    {
	    return $this->hasMany(Rsvp::class);
    }
}
