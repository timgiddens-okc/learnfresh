<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\ScheduleDay;
use App\ScheduleItem;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
	public function printSchedule(Schedule $schedule)
	{
		$pdf = PDF::loadView('schedule.pdf', [
			"schedule" => $schedule
		]);
		return $pdf->download($schedule->title . ' Schedule.pdf');
	}
	
	public function editItem(Schedule $schedule, ScheduleItem $scheduleItem)
	{
		$scheduleItem->load("day");

		return view("schedule.edit-item", [
			"schedule" => $schedule,
			"item" => $scheduleItem
		]);
	}
	
	public function updateItem(Schedule $schedule, ScheduleItem $scheduleItem, Request $request)
	{
		$scheduleItem->update($request->all());
		
		\Session::flash("alert-success", "The item in the itinerary has been updated!");
		return redirect("/schedule/".$schedule->id);
	}
	
	public function deleteItem(Schedule $schedule, ScheduleItem $scheduleItem)
	{
		$scheduleItem->delete();
		
		\Session::flash("alert-success", "The item in the itinerary has been deleted!");
		return back();
	}
	
	public function schedule(Schedule $schedule)
	{
		return view("schedule.show", [
			"schedule" => $schedule
		]);
	}
	
    public function index()
    {
	    $schedules = Schedule::all();
	    return view("schedule.index", [
		    "schedules" => $schedules
	    ]);
    }
    
    public function create()
    {
	    return view("schedule.new");
    }
    
    public function addSchedule(Request $request)
    {
	    $this->validate($request, [
		    "title" => "unique:schedules|required"
	    ]);
	    
	    $schedule = Schedule::create([
		    "title" => $request->input("title")
	    ]);
	    
	    return redirect("/schedule/".$schedule->id."/days");
    }
    
    public function addDays(Schedule $schedule)
    {
	    return view("schedule.add-days", [
		    "schedule" => $schedule
	    ]);
    }
    
    public function createDays(Request $request, Schedule $schedule)
    {
	    $length = count($request->input("title"));
	    
	    for($x = 0; $x < $length; $x++){
		    if($request->input("title")[$x] != ""){
			    $day = ScheduleDay::create([
				    "title" => $request->input("title")[$x],
				    "date" => \Carbon\Carbon::parse($request->input("date")[$x])
			    ]);
			    
			    $schedule->days()->save($day);
		    }
	    }
	    
	    \Session::flash("alert-success", "The days have been added to the schedule! Make sure you go in and fill in the itinerary.");
	    return redirect("/national-championship/schedule");
    }
    
    public function itinerary(Schedule $schedule, ScheduleDay $scheduleDay)
    {
	    return view("schedule.itinerary", [
		    "schedule" => $schedule,
		    "scheduleDay" => $scheduleDay
	    ]);
    }
    
    public function saveItinerary(Request $request, Schedule $schedule, ScheduleDay $scheduleDay)
    {
	    $length = count($request->input("start_time"));
	    
	    for($x = 0; $x < $length; $x++){
		    if($request->input("start_time")[$x] != ""){
			    $item = ScheduleItem::create([
				    "start_time" => $request->input("start_time")[$x],
				    "end_time" => $request->input("end_time")[$x],
				    "event_name" => $request->input("event_name")[$x],
				    "event_location" => $request->input("event_location")[$x],
				    "event_address" => $request->input("event_address")[$x],
				    "event_details" => $request->input("event_details")[$x]
			    ]);
			    
			    $scheduleDay->items()->save($item);
		    }
	    }
	    
	    \Session::flash("alert-success", "The items have been added.");
	    return redirect("/schedule/" . $schedule->id);
    }
}
