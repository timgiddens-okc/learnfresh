<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventPhoto;
use App\User;
use App\Rsvp;
use App\FundedRegion;
use App\Checkpoint;
use App\Mail\ChampionshipEmail;
use App\Mail\TrainingEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\EventInYourArea;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

class EventController extends Controller
{
		public function regionEvents()
		{
			$team = FundedRegion::where('zip_code', \Auth::user()->shipping_zip_code)->first();
			$events = Event::where('team',$team->team)->where('event_date','>',\Carbon\Carbon::now())->paginate(20);

			return view("region-events", [
				"events" => $events
			]);
		}
	
		public function openRegistration(Event $event)
		{
			$event->registration_open = 1;
			$event->save();
			
			\Session::flash("alert-success","Registration has been opened!");
			return back();
		}
		
		public function closeRegistration(Event $event)
		{
			$event->registration_open = 0;
			$event->save();
			
			\Session::flash("alert-success","Registration has been closed!");
			return back();
		}
	
		public function preRegister(Event $event)
		{
			$open = true;
			$events = null;
			if($event->registration_cap){
				if(count($event->rsvps) >= $event->registration_cap){
					$open = false;
					$events = Event::where('team',$event->team)->where('event_date','>',\Carbon\Carbon::now())->where('id', '!=', $event->id)->get();
				}
			}
			if($event->registration_open == 0){
				$open = false;
			}
			if($event->address){
				Mapper::location($event->address)->map(['zoom'=>13]);
			}
			return view("events.pre-register", [
				"event" => $event,
				"events" => $events,
				"open" => $open
			]);
		}
		
		public function preRegisterSubmit(Event $event, Request $request)
		{
			$rsvp = Rsvp::create([
				"event_id" => $event->id,
				"name" => $request->input("name"),
				"email" => $request->input("email"),
				"phone" => $request->input("phone"),
				"school_program_name" => $request->input("school_program_name")
			]);
			
			$event->rsvps()->save($rsvp);
			
			\Session::flash("alert-success", "You are successfully registered!");
			return back();
		}
	
		public function calendarFilter(Request $request)
		{
			if($request->input('type') == "all"){
				return redirect("/events/calendar");
			} else {
				if($request->input('type') == "6"){
					$e = [];
					$checkpoints = Checkpoint::orderBy('close_date')->get();
					
					foreach($checkpoints as $checkpoint){
						$type = "#ff0000";
						$link = "";
						$closeDate = \Carbon\Carbon::parse($checkpoint->close_date)->addDays(1);
						if($checkpoint->open_date < \Carbon\Carbon::now() && $checkpoint->close_date > \Carbon\Carbon::now()){
							$link = "/checkpoint";
						}
						if(\Auth::user()->isAdmin()){
							$link = "/admin/checkpoint/" . $checkpoint->id;
						}
						$e[] = \Calendar::event(
							"Checkpoint",
							false,
							$checkpoint->open_date,
							$closeDate,
							$checkpoint->id,
							[
								'url' => $link,
								'color' => $type
							]
						);
					}
				} else {
					$e = [];
					$events = Event::where("type", $request->input('type'))->orderBy('event_date')->get();
					
					foreach($events as $event){
						$type = "";
						switch($event->type){
							case "1":
								$type = "#ffc400";
								break;
							case "2":
								$type = "#08c700";
								break;
							case "3":
								$type = "#0092ff";
								break;
							case "4":
								$type = "#c400ff";
								break;
							case "5":
								$type = "#000000";
								break;
							case "6":
								$type = "#ff0000";
								break;
							default:
								$type = "#000000";
								break;
						}
						if($event->end_date){
							$e[] = \Calendar::event(
								$event->title,
								false,
								$event->event_date,
								$event->end_date,
								$event->id,
								[
									'url' => "/event/" . $event->id,
									'color' => $type,
									'description' => $event->description
								]
							);
						} else {
							$e[] = \Calendar::event(
								$event->title,
								true,
								$event->event_date,
								$event->event_date,
								$event->id,
								[
									'url' => "/event/" . $event->id,
									'color' => $type,
									'description' => $event->description
								]
							);	
						}
					}
				}
				
				$calendar = \Calendar::addEvents($e)->setOptions([
					'header' => array('left' => 'prev,next prevYear,nextYear today', 'center' => 'title', 'right' => 'month,basicWeek,basicDay')
				]);
				
				return view("events.calendar-filtered", compact('calendar'));
			}
		}
	
		public function calendar()
		{
			$e = [];
			$events = Event::orderBy('event_date')->get();
			$checkpoints = Checkpoint::orderBy('close_date')->get();
			
			foreach($checkpoints as $checkpoint){
				$type = "#ff0000";
				$link = "";
				$closeDate = \Carbon\Carbon::parse($checkpoint->close_date)->addDays(1);
				if($checkpoint->open_date < \Carbon\Carbon::now() && $checkpoint->close_date > \Carbon\Carbon::now()){
					$link = "/checkpoint";
				}
				if(\Auth::user()->isAdmin()){
					$link = "/admin/checkpoint/" . $checkpoint->id;
				}
				$e[] = \Calendar::event(
					"Checkpoint",
					false,
					$checkpoint->open_date,
					$closeDate,
					$checkpoint->id,
					[
						'url' => $link,
						'color' => $type
					]
				);
			}
			
			foreach($events as $event){
				$type = "";
				switch($event->type){
					case "1":
						$type = "#ffc400";
						break;
					case "2":
						$type = "#08c700";
						break;
					case "3":
						$type = "#0092ff";
						break;
					case "4":
						$type = "#c400ff";
						break;
					case "5":
						$type = "#000000";
						break;
					case "6":
						$type = "#ff0000";
						break;
					default:
						$type = "#000000";
						break;
				}
				if($event->end_date){
					$e[] = \Calendar::event(
						$event->title,
						false,
						$event->event_date,
						$event->end_date,
						$event->id,
						[
							'url' => "/event/" . $event->id,
							'color' => $type,
							'description' => $event->description
						]
					);
				} else {
					$e[] = \Calendar::event(
						$event->title,
						true,
						$event->event_date,
						$event->event_date,
						$event->id,
						[
							'url' => "/event/" . $event->id,
							'color' => $type,
							'description' => $event->description
						]
					);	
				}
			}
			
			$calendar = \Calendar::addEvents($e)->setOptions([
				'header' => array('left' => 'prev,next prevYear,nextYear today', 'center' => 'title', 'right' => 'month,basicWeek,basicDay')
			]);
			
			return view("events.calendar", compact('calendar'));
		}
	
	
		public function editAttendeeRsvp(Rsvp $rsvp)
		{
			return view("admin.events.edit-attendee", [
				"attendee" => $rsvp
			]);
		}
		
		public function updateAttendeeRsvp(Rsvp $rsvp, Request $request)
		{
			$rsvp->students = $request->input('students');
			$rsvp->additional_guests = $request->input('additional_guests');
			$rsvp->shirt_sizes = $request->input('shirt_sizes');
			$rsvp->update();
			\Session::flash('alert-success', "The rsvp has been updated!");
			return redirect("/event/" . $rsvp->event_id);
		}	
		
		public function cancelRsvp(Rsvp $rsvp)
		{
			$rsvp->delete();
			\Session::flash('alert-success', "The rsvp has been canceled!");
			return redirect("/event/" . $rsvp->event_id);
		}	

		public function sendEmail(Event $event){
			$search = "";
			$address = explode(" ", $event->address);
			$state = strtoupper($address[count($address)-2]);
			$zipcode = (int)$address[count($address)-1];
			
			$query = User::query();
			
			switch($state) {
				case ("AL"):
					$search = ["AL"];
					break;
				case ("AZ"):
					$search = ["AZ", "NM"];
					break;
				case ("AR"):
					$search = ["AR"];
					break;
				case ("CA"):
					if(in_array($zipcode,range(93890,94199)) || in_array($zipcode,range(94301,95200))) {
						// Golden State Warriors
						$query = $query->where([["shipping_zip_code",">=",93890],["shipping_zip_code","<=",94199]]);
						$query = $query->orWhere([["shipping_zip_code",">=",94301],["shipping_zip_code","<=",95200]]);
					} elseif (in_array($zipcode,range(94200,94300)) || in_array($zipcode,range(95201,96162))) {
						// Sacramento Kings
						$query = $query->where([["shipping_zip_code",">=",94200],["shipping_zip_code","<=",94300]]);
						$query = $query->orWhere([["shipping_zip_code",">=",95201],["shipping_zip_code","<=",96162]]);
					} elseif (in_array($zipcode,range(90000,93889))) {
						// LA Clippers
						$query = $query->where([["shipping_zip_code",">=",90000],["shipping_zip_code","<=",93889]]);
					}
					break;
				case ("CO"):
					$search = ["CO","WY","NE","KS","MT","ND","SD"];
					break;
				case ("CT"):
					$search = ["NY","CT","VT"];
					break;
				case ("DE"):
					$search = ["NJ","PA","DE","MD"];
					break;
				case ("FL"):
					$search = ["FL"];
					break;
				case ("GA"):
					$search = ["GA"];
					break;
				case ("ID"):
					$search = ["UT","NV","ID"];
					break;
				case ("IA"):
					$search = ["WI","MN","IA"];
					break;
				case ("KS"):
					$search = ["CO","WY","NE","KS","MT","ND","SD"];
					break;
				case ("KY"):
					$search = ["KY"];
					break;
				case ("LA"):
					$search = ["LA","MS"];
					break;
				case ("MD"):
					$search = ["NJ","PA","DE","MD"];
					break;
				case ("MI"):
					$search = ["MI"];
					break;
				case ("MN"):
					$search = ["WI","MN","IA"];
					break;
				case ("MS"):
					$search = ["LA","MS"];
					break;
				case ("MT"):
					$search = ["CO","WY","NE","KS","MT","ND","SD"];
					break;
				case ("NE"):
					$search = ["CO","WY","NE","KS","MT","ND","SD"];
					break;
				case ("NV"):
					$search = ["UT","NV","ID"];
					break;
				case ("NJ"):
					$search = ["NJ","PA","DE","MD"];
					break;
				case ("NM"):
					$search = ["AZ","NM"];
					break;
				case ("NY"):
					$search = ["NY","CT","VT"];
					break;
				case ("NC"):
					$search = ["NC","SC"];
					break;
				case ("ND"):
					$search = ["CO","WY","NE","KS","MT","ND","SD"];
					break;
				case ("OH"):
					$search = ["OH","WV"];
					break;
				case ("OR"):
					$search = ["OR","WA"];
					break;
				case ("PA"):
					$search = ["NJ","PA","DE","MD"];
					break;
				case ("SC"):
					$search = ["NC","SC"];
					break;
				case ("SD"):
					$search = ["CO","WY","NE","KS","MT","ND","SD"];
					break;
				case ("UT"):
					$search = ["UT","NV","ID"];
					break;
				case ("VT"):
					$search = ["NY","CT","VT"];
					break;
				case ("WA"):
					$search = ["OR","WA"];
					break;
				case ("WV"):
					$search = ["OH","WV"];
					break;
				case ("WI"):
					$search = ["WI","MN","IA"];
					break;
				case ("WY"):
					$search = ["CO","WY","NE","KS","MT","ND","SD"];
					break;
			}
			
			$results = "";
			
			if($state != "CA"){
				$results = $query->whereIn("shipping_state", $search)->get();
			} else {
				$results = $query->get();
			}
			
			if(count($results) > 0){
				foreach($results as $user){
					if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){
						\Mail::to($user->email)->send(new ChampionshipEmail($event));
					}
				}
				\Session::flash("alert-success", count($results) . " email(s) were sent.");
			} else {
				\Session::flash("alert-danger", "No users were found in this area.");
			}
			
			return redirect("/event/" . $event->id);
		}
		
	public function sendTrainingEmail(Event $event){
		$search = "";
		$address = explode(" ", $event->address);
		$state = strtoupper($address[count($address)-2]);
		$zipcode = (int)$address[count($address)-1];
		
		$query = User::query();
		
		switch($state) {
			case ("AL"):
				$search = ["AL"];
				break;
			case ("AZ"):
				$search = ["AZ", "NM"];
				break;
			case ("AR"):
				$search = ["AR"];
				break;
			case ("CA"):
				if(in_array($zipcode,range(93890,94199)) || in_array($zipcode,range(94301,95200))) {
					// Golden State Warriors
					$query = $query->where([["shipping_zip_code",">=",93890],["shipping_zip_code","<=",94199]]);
					$query = $query->orWhere([["shipping_zip_code",">=",94301],["shipping_zip_code","<=",95200]]);
				} elseif (in_array($zipcode,range(94200,94300)) || in_array($zipcode,range(95201,96162))) {
					// Sacramento Kings
					$query = $query->where([["shipping_zip_code",">=",94200],["shipping_zip_code","<=",94300]]);
					$query = $query->orWhere([["shipping_zip_code",">=",95201],["shipping_zip_code","<=",96162]]);
				} elseif (in_array($zipcode,range(90000,93889))) {
					// LA Clippers
					$query = $query->where([["shipping_zip_code",">=",90000],["shipping_zip_code","<=",93889]]);
				}
				break;
			case ("CO"):
				$search = ["CO","WY","NE","KS","MT","ND","SD"];
				break;
			case ("CT"):
				$search = ["NY","CT","VT"];
				break;
			case ("DE"):
				$search = ["NJ","PA","DE","MD"];
				break;
			case ("FL"):
				$search = ["FL"];
				break;
			case ("GA"):
				$search = ["GA"];
				break;
			case ("ID"):
				$search = ["UT","NV","ID"];
				break;
			case ("IA"):
				$search = ["WI","MN","IA"];
				break;
			case ("KS"):
				$search = ["CO","WY","NE","KS","MT","ND","SD"];
				break;
			case ("KY"):
				$search = ["KY"];
				break;
			case ("LA"):
				$search = ["LA","MS"];
				break;
			case ("MD"):
				$search = ["NJ","PA","DE","MD"];
				break;
			case ("MI"):
				$search = ["MI"];
				break;
			case ("MN"):
				$search = ["WI","MN","IA"];
				break;
			case ("MS"):
				$search = ["LA","MS"];
				break;
			case ("MT"):
				$search = ["CO","WY","NE","KS","MT","ND","SD"];
				break;
			case ("NE"):
				$search = ["CO","WY","NE","KS","MT","ND","SD"];
				break;
			case ("NV"):
				$search = ["UT","NV","ID"];
				break;
			case ("NJ"):
				$search = ["NJ","PA","DE","MD"];
				break;
			case ("NM"):
				$search = ["AZ","NM"];
				break;
			case ("NY"):
				$search = ["NY","CT","VT"];
				break;
			case ("NC"):
				$search = ["NC","SC"];
				break;
			case ("ND"):
				$search = ["CO","WY","NE","KS","MT","ND","SD"];
				break;
			case ("OH"):
				$search = ["OH","WV"];
				break;
			case ("OR"):
				$search = ["OR","WA"];
				break;
			case ("PA"):
				$search = ["NJ","PA","DE","MD"];
				break;
			case ("SC"):
				$search = ["NC","SC"];
				break;
			case ("SD"):
				$search = ["CO","WY","NE","KS","MT","ND","SD"];
				break;
			case ("UT"):
				$search = ["UT","NV","ID"];
				break;
			case ("VT"):
				$search = ["NY","CT","VT"];
				break;
			case ("WA"):
				$search = ["OR","WA"];
				break;
			case ("WV"):
				$search = ["OH","WV"];
				break;
			case ("WI"):
				$search = ["WI","MN","IA"];
				break;
			case ("WY"):
				$search = ["CO","WY","NE","KS","MT","ND","SD"];
				break;
		}
		
		$results = "";
		
		if($state != "CA"){
			$results = $query->whereIn("shipping_state", $search)->get();
		} else {
			$results = $query->get();
		}
		
		if(count($results) > 0){
			foreach($results as $user){
				if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){
					\Mail::to($user->email)->send(new TrainingEmail($event));
				}
			}
			\Session::flash("alert-success", count($results) . " email(s) were sent.");
		} else {
			\Session::flash("alert-danger", "No users were found in this area.");
		}
		
		return redirect("/event/" . $event->id);
	}
	
    public function index()
    {
	    $events = Event::where("event_date",">",Carbon::today()->toDateString())->orderBy('event_date')->take(3)->get();
    	return view('admin.events.index', [
	    	'events' => $events
    	]);
    }
    
    public function all()
    {
	    $events = Event::where("event_date",">",Carbon::today()->toDateString())->orderBy('event_date')->paginate(12,['*'], 'upcoming');
	    $pastEvents = Event::where("event_date","<",Carbon::today()->toDateString())->orderBy('event_date','desc')->paginate(12, ['*'], 'past');
    	return view('events.index', [
	    	'events' => $events,
	    	'pastevents' => $pastEvents
    	]);
    }
    
    public function edit(Event $event)
    {
    			return view('admin.events.edit',[
	    			'event' => $event
    			]);
    }
    
    public function delete(Event $event)
    {
    	Rsvp::where('event_id',$event->id)->delete();
    	$event->delete();
    	\Session::flash('alert-success','The event has been deleted!');
	    return redirect('/home');
    }
    
    public function show(Event $event)
    {
	    if($event->address){
	    	Mapper::location($event->address)->map(['zoom'=>13]);
	    }
	    	
  			return view('admin.events.show', [
    			'event' => $event
  			]);
    }
    
    public function addImages(Request $request, Event $event)
    {
	    foreach($request->file('images') as $file){
		    $eventImage = new EventPhoto();
		    
    		$fileName = time() . '.' . $file->getClientOriginalExtension();
				$file->move(base_path() . '/public/event-files/images/', $fileName);
				$uploadedFile = "/event-files/images/" . $fileName;
				$eventImage->url = $uploadedFile;
				
				$event->addImage($eventImage);
				
				$eventImage->save();
	    }
	    
	    \Session::flash('alert-success','The event images have been added!');
	    return redirect("event/" . $event->id);
    }
    
    public function deleteImage(EventPhoto $eventPhoto)
    {
	    $event = $eventPhoto->event_id;
	    $eventPhoto->delete();
	    
	    \Session::flash('alert-success','The event image has been deleted.');
	    return redirect("/event/" . $event . "/edit");
    }
    
    public function update(Request $request, Event $event)
    {
	    $event->update($request->except('remove_release_form', 'remove_participation_certificate'));
	    
	    if($request->file('release_form')){	    
    		$file = $request->file('release_form');
    		$fileName = time() . '.' . $file->getClientOriginalExtension();
				$file->move(base_path() . '/public/event-files/release_forms/', $fileName);
				$uploadedFile = "/event-files/release_forms/" . $fileName;
				$event->release_form = $uploadedFile;
    	}
    	
    	if($request->file('participation_certificate')){	    
    		$file2 = $request->file('participation_certificate');
    		$fileName = time() . '.' . $file2->getClientOriginalExtension();
				$file2->move(base_path() . '/public/event-files/certificates/', $fileName);
				$uploadedFile = "/event-files/certificates/" . $fileName;
				$event->participation_certificate = $uploadedFile;
    	}
    	
    	if($request->input('remove_release_form')){
	    	$event->release_form = null;
    	}
    	
    	if($request->input('remove_participation_certificate')){
	    	$event->participation_certificate = null;
    	}
    	
    	if($request->input('registration_cap') <= 0){
	    	$event->registration_cap = null;
    	}
    	
    	$event->save();
	    
    	return redirect('/event/' . $event->id);
    }
    
    public function store(Request $request)
    {
    		$this->validate($request, [
	    		'title' => 'required',
	    		'location' => 'required',
	    		'event_date' => 'required',
    		]);
    		
    		$event = new Event($request->all());
    		
    		$eventDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s e', $request->input('event_date') . ' ' . $request->input('timezone'));
    		$endDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s e', $request->input('end_date') . ' ' . $request->input('timezone'));
    		
    		$event->event_date = $eventDate;
    		$event->end_date = $endDate;
    		
    		if($request->input('registration_cap') <= 0){
	    		$event->registration_cap = null;
    		}
    		
    		if($request->file('release_form')){	    
	    		$file = $request->file('release_form');
	    		$fileName = time() . '.' . $file->getClientOriginalExtension();
					$file->move(base_path() . '/public/event-files/release_forms/', $fileName);
					$uploadedFile = "/event-files/release_forms/" . $fileName;
					$event->release_form = $uploadedFile;
	    	}
	    	
	    	if($request->file('participation_certificate')){	    
	    		$file = $request->file('participation_certificate');
	    		$fileName = time() . '.' . $file->getClientOriginalExtension();
					$file->move(base_path() . '/public/event-files/certificates/', $fileName);
					$uploadedFile = "/event-files/certificates/" . $fileName;
					$event->participation_certificate = $uploadedFile;
	    	}
    		
    		$event->save();
    		
    		$address = explode(" ", $event->address);
    		
    		$zip = end($address);
    		
    		$users = User::where("admin",0)->get();
    		
    		foreach($users as $user){
	    		if($zip == $user->shipping_zip_code){
		    		$user->notify(new EventInYourArea($event));
	    		}
    		}
    		
    		return back();
    }
}
