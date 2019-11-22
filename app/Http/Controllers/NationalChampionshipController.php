<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\View;
use App\Vote;

class NationalChampionshipController extends Controller
{
    public function applicants()
    {
	    $applications = Application::orderBy('team_region')->orderBy('student_name')->get();
	    
	    return view("national-championship.applicants", [
		    "applications" => $applications
	    ]);
    }
    
    public function application(Application $application)
    {
	    if(!View::where('application_id',$application->id)->where('user_id',\Auth::user()->id)->exists()){
		    View::create([
			   "application_id" => $application->id,
			   "user_id" => \Auth::user()->id 
		    ]);
	    }
	    
	    $previous = Application::where('id','<',$application->id)->orderBy('id','desc')->first();
	    $next = Application::where('id','>',$application->id)->orderBy('id')->first();
	    
	    return view("national-championship.single-application", [
		    "application" => $application,
		    "previous" => $previous,
		    "next" => $next
	    ]);
    }
    
    public function nominate(Application $application)
    {
	    if(Vote::where('application_id',$application->id)->where('user_id',\Auth::user()->id)->exists()){
		    $vote = Vote::where('application_id',$application->id)->where('user_id',\Auth::user()->id)->first();
		    $vote->delete();
		    \Session::flash("alert-success","This nomination has been removed!");
	    } else {
		    $vote = Vote::create([
			    "application_id" => $application->id,
			    "user_id" => \Auth::user()->id
		    ]);
		    $application->votes()->save($vote);
		    \Session::flash("alert-success","This student has been nominated!");
	    }
	   
	    return back();
    }
    
    public function votes()
    {
	    $votes = Vote::where("user_id", \Auth::user()->id)->get();
	    $fullVotes = Application::with('votes')->get()->sortBy(function($application){
		    return $application->votes->count();
	    }, null, true);
	    
	    return view("national-championship.votes", [
		    "votes" => $votes,
		    "fullVotes" => $fullVotes
	    ]);
    }
    
    public function participants()
    {
	    $applications = Application::where("status", 1)->get();
	    
	    return view("national-championship.participants", [
		    "applications" => $applications
	    ]);
    }
    
    public function status(Request $request, Application $application)
    {
	    $application->status = $request->input('status');
	    $application->save();
    }
    
    public function editApplication(Application $application)
    {
	    return view("national-championship.edit-application", [
		    "application" => $application
	    ]);
    }
    
    public function updateApplication(Request $request, Application $application)
    {
	    $application->update($request->all());
	    $application->save();
	   
		\Session::flash("alert-success", "Application updated!");
		return redirect("/national-championship/applicants");
    }
}
