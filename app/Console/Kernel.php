<?php

namespace App\Console;

use App\SavedCheckpoint;
use Excel;
use App\User;
use App\Week;
use App\Rsvp;
use App\Checkpoint;
use App\Preassessment;
use App\Postassessment;
use App\CompletedWeek;
use App\CheckpointResult;
use App\ShippingList;
use App\WeeksNotification;
use App\Mail\SendOrders;
use App\Mail\PaymentReminder;
use App\Notifications\WeekAvailable;
use App\Notifications\WeeklyTipLive;
use App\Notifications\WeeklyTipReminder;
use App\Notifications\CheckpointLive;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
      Commands\RunScheduler::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
	    
	    	// This function deletes test accounts - marked as type 0
	    	$schedule->call(function () {
		    	
		    	$users = User::where('type',0)->get();
    	
		    	foreach($users as $user){
			    	$user->topics()->delete();
			    	$students = $user->students;
			    	foreach($students as $student){
				    	Preassessment::where('student_id',$student->id)->delete();
				    	Postassessment::where('student_id',$student->id)->delete();
			    	}
			    	$user->students()->delete();
			    	$user->comments()->delete();
			    	Rsvp::where('user_id',$user->id)->delete();
			    	CompletedWeek::where('user_id',$user->id)->delete();
			    	CheckpointResult::where('user_id',$user->id)->delete();
			    	$user->delete();
		    	}
		    	
	    	})->daily()->timezone('America/New_York')->between('21:00','23:00');
        
        // Pretest reminder
        $schedule->call(function () {
	        $users = User::where('admin',0)->where('paid','!=',0)->get();
	        
	        foreach($users as $user){
		        if($user->pre_assessment_completion == "0" || $user->pre_assessment_completion == 0){
							$user->notify(new PretestReminder());
						}
					}
	        
        })->weekly()->fridays()->timezone('America/New_York')->between('18:00','19:30');
        
        
        // Archiving Checkpoint Results
        $schedule->call(function () {
	        $checkpoint = Checkpoint::first();
	        
	        if(count($checkpoint) == 0){
		        $results = CheckpointResult::all();
						$title = md5(time());
						
						foreach($results as $result){
							unset($result->id);
							unset($result->created_at);
							unset($result->updated_at);
						}
						
						$filepath = Excel::create($title, function($excel) use($results) {
					    $excel->sheet('Results', function($sheet) use($results) {
						    $sheet->fromArray($results);
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
					}
        })->weekly()->fridays()->timezone('America/New_York')->between('9:00','17:00');
        
        // Advance weeks
        $schedule->call(function () {
	        $users = User::where('admin',0)->where('paid','!=',0)->where('pre_assessment_complete','=',1)->get();
	        
	        foreach($users as $user){
		        $finishedWeek = CompletedWeek::where("user_id",$user->id)->orderBy('created_at','desc')->first();
		        $lastWeek = 1;
		        
		        if($finishedWeek){
		        	$lastWeek = (int)$finishedWeek->week_number;
		        	if($lastWeek == 12){
			        	// Completed weeks
		        	} else {
			        	$lastWeek++;
			        	CompletedWeek::create([
					        "user_id" => $user->id,
					        "week_number" => $lastWeek,
					        "notified" => 0
				        ]);
			        }
		        } else {
			        CompletedWeek::create([
				        "user_id" => $user->id,
				        "week_number" => $lastWeek,
				        "notified" => 0
			        ]);
		        }
		        if($lastWeek < 12){
		        	$lastWeek++;
		        	$week = Week::where("week_number",$lastWeek)->first();
		        	if($week){
		        		$user->notify(new WeeklyTipLive($week));
		        	}
		        }
		        
					}
        })->weekly()->mondays()->timezone('America/New_York')->at('9:00');

        
        // Weekly Tip Reminder
        $schedule->call(function () {
	        $users = User::where('admin',0)->where('paid','!=',0)->get();
	        
	        foreach($users as $user){
		        $finishedWeek = CompletedWeek::where("user_id",$user->id)->orderBy('created_at','desc')->first();
		        $lastWeek = 0;
		        if($finishedWeek){
		        	$lastWeek = (int)$finishedWeek->week_number;
		        }
		        if($lastWeek < 12){
		        	$lastWeek++;
		        	$week = Week::where("week_number",$lastWeek)->first();
		        	if($week){
		        		$user->notify(new WeeklyTipReminder($week));
		        	}
		        }
		        
					}
        })->weekly()->wednesdays()->timezone('America/New_York')->at('9:00');
        
        // New Checkpoint Is Live

        $schedule->call(function () {
	        $checkpoint = Checkpoint::where('open_date','<',\Carbon\Carbon::now('America/Los_Angeles'))->where('close_date','>',\Carbon\Carbon::now('America/Los_Angeles'))->first();
	        
	        if($checkpoint){
		        $users = User::where('admin',0)->where('paid','!=',0)->get();
		        	    
				    foreach($users as $user){
					    $result = CheckpointResult::where([['user_id','=',$user->id],['checkpoint_id','=',$checkpoint->id]])->first();
					    if(!$result && $user->account_level == 2){
						    $user->notify(new CheckpointLive());
					    }
				    }
			    }
        })->weekly()->wednesdays()->timezone('America/New_York')->at('9:00');
        
        // Second Checkpoint Live Reminder
        $schedule->call(function () {
	        $checkpoint = Checkpoint::where('open_date','<',\Carbon\Carbon::now('America/Los_Angeles'))->where('close_date','>',\Carbon\Carbon::now('America/Los_Angeles'))->first();
	        
	        if($checkpoint){
		        $users = User::where('admin',0)->where('paid','!=',0)->get();
		        	    
				    foreach($users as $user){
					    $result = CheckpointResult::where([['user_id','=',$user->id],['checkpoint_id','=',$checkpoint->id]])->first();
					    if(!$result && $user->account_level == 2){
						    $user->notify(new CheckpointLive());
					    }
				    }
			    }
        })->weekly()->fridays()->timezone('America/New_York')->at('9:00');
        
        
        // Sending Orders to Fullfillment
        $schedule->call(function () {
	        $orders = ShippingList::where('archived',0)->where(function($query){
		        $query->where('created_at','<=', \Carbon\Carbon::now('America/Los_Angeles')->subDay())
		        	  ->orWhere('submitted_by', 1);
		    })->get();
	        $title = "Learn Fresh Order List";
	        $file = "";
	        
	        if(count($orders) > 0){
		        
		        foreach($orders as $result){
							unset($result->id);
							unset($result->created_at);
							unset($result->updated_at);
							unset($result->archived);
						}
		        
		        $file = Excel::create($title, function($excel) use($orders) {
					    $excel->sheet('Orders', function($sheet) use($orders) {
						    $sheet->fromArray($orders);
					    });
				    });
	        }
	        
	        $emails = ['jeff@learnfresh.org','tbryant@fulfillmentcenter.com'];
	        \Mail::to($emails)->send(new SendOrders($file));
	        
	        $orders = ShippingList::where('archived',0)->where(function($query){
		        $query->where('created_at','<=', \Carbon\Carbon::now('America/Los_Angeles')->subDay())
		        	  ->orWhere('submitted_by', 1);
		    })->get();
	        foreach($orders as $order){
		        $order->archived = 1;
		        $order->save();
	        }
        })->daily()->timezone('America/Los_Angeles')->at('0:00');
        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
