<?php

namespace App\Http\Controllers;

use App\Rsvp;
use App\Event;
use App\Mail\EventCommunication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RsvpController extends Controller
{
    public function rsvp(Event $event)
    {
	    	    
	    $rsvp = Rsvp::create([
		    'event_id' => $event->id,
		    'user_id' => \Auth::user()->id
	    ]);
	    
	    $event->rsvps()->save($rsvp);
	    
	    Session::flash('rsvp', 'Thank you for RSVPing for ' . $event->title . '!');
	    
	    return back();
    }
    
    public function rsvpWithKids(Event $event, Request $request)
    {

	    if($event->id == 113){
		    $studentCount = 0;
		    $rsvps = Rsvp::where('event_id',$event->id)->get();
		    foreach($rsvps as $rsvp){
			    $theseStudents = explode(",", $rsvp->students);
			    $studentCount += count($theseStudents);
		    }
		    
		    $studentCount += count($request->input('students'));
	    
			if($studentCount > 60){
				Session::flash('alert-danger', 'Unfortunately, your RSVP put us over our max capacity. You can try to RSVP less students.');
				return back();
			}
	    }
	    
	    $students = "";
	    $shirt_sizes = "";
	    
	    if($request->input('students')){
		    foreach($request->input('students') as $student){
			    $students .= $student . ", ";
		    }
		    
		    $students = substr($students,0,-2);
	    } else {
		    $students = "None";
	    }
	    
	    if($request->input('shirt_sizes')){
		    foreach($request->input('shirt_sizes') as $shirt){
			    if($shirt != ""){
			    $shirt_sizes .= $shirt . ", ";
			    }
		    }
		    
		    $shirt_sizes = substr($shirt_sizes,0,-2);
	    } else {
		    $shirt_sizes = "None";
	    }
	    	    
	    $rsvp = Rsvp::create([
		    'event_id' => $event->id,
		    'user_id' => \Auth::user()->id,
		    'students' => $students,
		    'additional_guests' => $request->input('additional_guests'),
		    'shirt_sizes' => $shirt_sizes
	    ]);
	    
	    $event->rsvps()->save($rsvp);
	    
	    Session::flash('rsvp', 'Thank you for RSVPing for ' . $event->title . '!');
	    
	    return back();
    }
    
    public function attendees(Event $event)
    {
	  	$attendees = Rsvp::where('event_id', $event->id)->get();
	  	
	  	return view('admin.events.attendees', [
		  	'attendees' => $attendees,
		  	'event' => $event
	  	]);
    }
    
    public function addAttendees(Event $event, Request $request)
    {
	    $rsvp = Rsvp::create([
		   "event_id" => $event->id,
		   "school_program_name" => $request->input("school_program_name"), 
		   "name" => $request->input("name"), 
		   "email" => $request->input("email"), 
		   "phone" => $request->input("phone"), 
		   "students" => $request->input("students"), 
		   "additional_guests" => $request->input("additional_guests"),
		   "shirt_sizes" => $request->input("shirt_sizes")
	    ]);
	    
	    $event->rsvps()->save($rsvp);
	    
	    Session::flash('rsvp', 'The attendee has been added!');
	    
	    return back();
    }
    
    public function email(Event $event)
    {
	    return view('admin.events.email', [
		    "event" => $event
	    ]);
    }
    
    public function sendEmail(Event $event, Request $request)
    {
	    $attendees = Rsvp::where('event_id', $event->id)->get();
	    
	    foreach($attendees as $att) {
		    $user = \App\User::find($att->user_id);
		    \Mail::to($user->email)->send(new EventCommunication($user,$request->input('subject'), $request->input('message')));
	    }
	    
	    \Session::flash("alert-success", "Message has been successfully sent!");
	    
	    return redirect('/event/' . $event->id . '/rsvp-list');
    }
}
