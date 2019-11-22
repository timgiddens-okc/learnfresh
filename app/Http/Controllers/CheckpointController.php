<?php

namespace App\Http\Controllers;

use App\User;
use App\Checkpoint;
use App\CheckpointResult;
use App\SavedCheckpoint;
use App\SubAdmin;
use Excel;
use App\Notifications\CheckpointLive;
use Illuminate\Http\Request;

class CheckpointController extends Controller
{
	public function create()
	{
		$checkpoints = Checkpoint::where("close_date",">",\Carbon\Carbon::now())->orderBy("open_date","desc")->get();
		return view("checkpoint.create", [
			"checkpoints" => $checkpoints
		]);
	}
	
	public function currentSeason()
	{
		$checkpoints = Checkpoint::where("archived",0)->get();
		return view("checkpoint.current", [
			"checkpoints" => $checkpoints
		]);
	}
	
	public function preview(Checkpoint $checkpoint)
	{
		return view("checkpoint.preview", [
			"checkpoint" => $checkpoint
		]);
	}
	
	public function data(Checkpoint $checkpoint)
	{
		$results = CheckpointResult::where("checkpoint_id",$checkpoint->id)->paginate(25);
	    $columns = \Schema::getColumnListing('checkpoint_results');
		return view("checkpoint.data", [
			"results" => $results,
		    "columns" => $columns,
			"checkpoint" => $checkpoint
		]);
	}
	
	public function edit(Checkpoint $checkpoint)
	{
		return view("checkpoint.edit", [
			"checkpoint" => $checkpoint
		]);
	}
	
	public function publish(Checkpoint $checkpoint)
	{
		$checkpoint->published = 1;
		$checkpoint->save();
		
		\Session::flash('alert-success', 'The checkpoint has been published!');
		return back();
	}
	
	public function unpublish(Checkpoint $checkpoint)
	{
		$checkpoint->published = 0;
		$checkpoint->save();
		
		\Session::flash('alert-success', 'The checkpoint has been un-published!');
		return back();
	}
	
	public function update(Checkpoint $checkpoint, Request $request) {
	    $checkpoint->update($request->all());
	    
	    \Session::flash('alert-success', 'The checkpoint has been updated!');
	    return redirect("/admin/checkpoint/" . $checkpoint->id);
    }
	
    public function index() {
	    $results = CheckpointResult::where("archived",0)->paginate(25);
	    $columns = \Schema::getColumnListing('checkpoint_results');
	    $checkpoint = Checkpoint::first();
	    $saved = SavedCheckpoint::all();
	    return view("checkpoint.index", [
		    "results" => $results,
		    "columns" => $columns,
		    "checkpoint" => $checkpoint,
		    "saved" => $saved
	    ]);
    }
    
    public function subAdminIndex() {
	    $sites = array();
			$su = SubAdmin::where("admin","=",\Auth::user()->id)->get();
			foreach($su as $u){
				$sites[] = $u->user;
			}
	    $results = CheckpointResult::whereIn('user_id', $sites)->orderBy('created_at','desc')->paginate(25);
	    $columns = \Schema::getColumnListing('checkpoint_results');
	    return view("sub-admin.checkpoints", [
		    "results" => $results,
		    "columns" => $columns
	    ]);
    }
    
    public function new(Request $request) {
	    Checkpoint::create($request->all());
	    
	    \Session::flash('alert-success', 'The checkpoint has been created!');
	    return back();
    }
    
    public function show() {
	    $checkpoint = Checkpoint::where("open_date","<",\Carbon\Carbon::now())->where("close_date",">",\Carbon\Carbon::now())->first();
	    
	    if(\Auth::user()->needsToCompleteCheckpoint()){
		    return view("checkpoint.show", [
			    "checkpoint" => $checkpoint
		    ]);
	    } else {
		    return redirect("/home");
	    }
    }
    
    public function store(Request $request) {
	    $thisCheckpoint = Checkpoint::where("open_date","<",\Carbon\Carbon::now('America/Los_Angeles'))->where("close_date",">",\Carbon\Carbon::now('America/Los_Angeles'))->first();
		$checkpoint = CheckpointResult::create($request->all());
	    $checkpoint->user_id = \Auth::user()->id;
	    $checkpoint->checkpoint_id = $thisCheckpoint->id;
	    $checkpoint->save();
	    
			\Session::flash('alert-success','Thank you for completing your checkpoint assessment!');
			return redirect("/home");
    }
    
    public function archive() {
	    $results = CheckpointResult::where("archived",0)->get();
			$title = md5(time());
			
			foreach($results as $result){
				unset($result->id);
				unset($result->created_at);
				unset($result->updated_at);
			}
			
			$filepath = Excel::create($title, function($excel) use($results) {
		    $excel->sheet('Results', function($sheet) use($results) {
			    	$sheet->appendRow(array(
				    	"Educator Name",
				    	"Educator Email",
					    "School/Program Name",
					    "Site Address",
					    "Shipping Address",
					    "Billing Address",
					    "Number of Estimated Students",
					    "Number of Pre-Tests Completed",
					    "Students Participating",
					    "Games Per Student",
					    "Curriculum Per Student",
					    "Sportsmanship Points Per Student",
					    "Games Played",
					    "Curriculum Completed",
					    "Sportsmanship Points",
					    "Students Eligible"
			    	));
			    foreach($results as $result){
				    $thisUser = \App\User::find($result->user_id);
				    
				    $site = $thisUser['site_address_1']."\n".$thisUser['site_address_2']."\n".$thisUser['site_city'] .", ". $thisUser['site_state']." ".$thisUser['site_zip_code'];
						$shipping = $thisUser['shipping_address_1']."\n".$thisUser['shipping_address_2']."\n".$thisUser['shipping_city'] .", ". $thisUser['shipping_state']." ".$thisUser['shipping_zip_code'];
						$billing = $thisUser['billing_address_1']."\n".$thisUser['billing_address_2']."\n".$thisUser['billing_city'] .", ". $thisUser['billing_state']." ".$thisUser['billing_zip_code'];						
						$students = array();
						foreach($thisUser['students'] as $student){
							$students[] = $student->id;
						}
						$pretestCount =  \App\Preassessment::whereIn("student_id", $students)->count();
				    
				    $sheet->appendRow(array(
					    $thisUser['name'],
					    $thisUser['email'],
					    $thisUser['school_program_name'],
					    $site,
					    $shipping,
					    $billing,
					    $thisUser['estimated_students'],
					    $pretestCount,
					    $result->studentsParticipating,
					    $result->gamesPerStudent,
					    $result->curriculumPerStudent,
					    $result->sportsmanshipPointsPerStudent,
					    $result->gamesPlayed,
					    $result->curriculumCompleted,
					    $result->sportsmanshipPoints,
					    $result->studentsEligible
						));
				  }
		    });
	    })->store('xls', false, true);
	    
	    SavedCheckpoint::create([
		    'file' => "/storage/exports/" . $filepath['file'],
		    'type' => 1
	    ]);
	    
			Checkpoint::truncate();

			
			$checkpointResults = CheckpointResult::where("archived",0)->get();
			
			foreach($checkpointResults as $checkpoint){
				$checkpoint->archived = 1;
				$checkpoint->save();
			}

	    \Session::flash("alert-success", "The results have been archived!");
	    return back();
    }
}
