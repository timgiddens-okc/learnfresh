<?php

namespace App\Http\Controllers;

use App\Week;
use App\Event;
use App\Topic;
use App\Resource;
use App\Program;
use App\Checkpoint;
use App\Championship;
use App\CompletedWeek;
use App\FundedRegion;
use App\Mail\SharePlatform;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    if(\Auth::check() && \Auth::user()->isAdmin()){
		    $weeks = Week::all();
		    $programs = Program::all();
		    $events = Event::where("event_date",">",Carbon::today()->toDateString())->orderBy('event_date')->take(3)->get();
		    $resources = Resource::take(3)->get();
		  	return view('admin.index', [
			  	'weeks' => $weeks,
			  	'programs' => $programs,
			  	'events' => $events,
			  	'resources' => $resources
		  	]);  
	    }
	    
	    $now = Carbon::now('America/Los_Angeles')->timezone('America/Chicago');
	    
	    $completed = 0;
	    
		$weekNumber = 1;
		$lastWeek = CompletedWeek::where("user_id",\Auth::user()->id)->orderBy('created_at', 'desc')->first();	
		
		if($lastWeek){
			$weekNumber = $lastWeek->week_number;
			$weekNumber++;
		}
					
		if(\Auth::user()->post_assessment_complete == "1"){
			$completed = 2;
		} else {
		
		if ($weekNumber > 12) {
			$weekNumber = 12;
			$completed = 1;
		}
		
		}
		
		$subscribed = [];
	    
	    
	    if(\Auth::user()->programs){
	    $programIds = explode(",", \Auth::user()->programs);
		} else {
		    $programIds = array("1");
	    }
			
		$weeks = Week::all();
		
		foreach($weeks as $key => $week) {
			if(!in_array($week->program_id, $programIds)){
				unset($weeks[$key]);
			}
		}
		
		
		if($weeks){
			$weeks->load('items');
		} else {
			$weeks = null;
		}
		
		if($completed != 0){
			$weeks = null;
		}
	

		
		$lfTweets = \Twitter::getUserTimeline(['screen_name' => 'learn_fresh', 'count' => 10, 'format' => 'object']);
		$kfTweets = \Twitter::getUserTimeline(['screen_name' => 'nbamathhoops', 'count' => 10, 'format' => 'object']);

		$tweets = array_merge($lfTweets,$kfTweets);
		
		usort($tweets, function($a,$b){
			return strtotime($b->created_at) - strtotime($a->created_at);
		});
		
		$tweets = array_slice($tweets,0,9);
		
		if(\Auth::user()->programs){
		$programs = explode(",",\Auth::user()->programs);
		
		} else {
		    $programs = array(1);
	    }
		
		$resources = array();
		
		foreach($programs as $program){
			$thisWeekNumber = $weekNumber;
			if($program == 3){
				if($thisWeekNumber > 8){
					$thisWeekNumber = 8;
				}
			}
			if($program == 4){
				if($thisWeekNumber > 9){
					$thisWeekNumber = 9;
				}
			}
			$thisWeek = Week::where('program_id',$program)->where('week_number',$thisWeekNumber)->first();
			$resources[] = Resource::where('id',$thisWeek['featured_resource'])->first();
		}
		

	    $events = Event::where("event_date",">",Carbon::today()->toDateString())->orderBy('event_date')->take(3)->get();
	    $topics = Topic::orderBy('created_at','DESC')->limit(3)->get();
	    $championship = Championship::first();
	    if($championship->display != 1){
		    $championship = null;
	    }
		
		$team = FundedRegion::where('zip_code',\Auth::user()->shipping_zip_code)->first();
		
		$gameNight = Event::where('team',$team->team)->where('type',7)->where('event_date','>',\Carbon\Carbon::now('America/Los_Angeles'))->orderBy('event_date')->first();
	    
	    $checkpoint = Checkpoint::where("open_date","<",\Carbon\Carbon::now('America/Los_Angeles'))->where("close_date",">",\Carbon\Carbon::now('America/Los_Angeles'))->first();
	    
      return view('home',[
	      'weeks' => $weeks,
	      'events' => $events,
	      'resources' => $resources,
	      'topics' => $topics,
	      'tweets' => $tweets,
	      'championship' => $championship,
	      'completed' => $completed,
	      'programs' => $programs,
	      'weekNumber' => $weekNumber,
	      'checkpoint' => $checkpoint,
	      'gameNight' => $gameNight,
	      'featuredResources' => $resources
      ]);
    }
    
    public function share(Request $request) {
	    \Mail::to($request->input('email'))->send(new SharePlatform("Check Out The LFCA!", $request->input('message')));
	    \Session::flash('alert-success','The message has been sent. Thank you for sharing the LFCA!');
	    return back();
    }
}
