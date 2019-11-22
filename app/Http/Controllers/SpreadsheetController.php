<?php

namespace App\Http\Controllers;

use App\User;
use App\Rsvp;
use App\Event;
use App\CheckpointResult;
use App\FundedRegion;
use App\ShippingList;
use App\KitOrder;
use Excel;
use Illuminate\Http\Request;

class SpreadsheetController extends Controller
{
		public function checkpointShippingList($checkpoint)
		{
			$results = CheckpointResult::where("checkpoint_id",$checkpoint)->get();
			$title = md5(time());
			
			foreach($results as $result){
				unset($result->id);
				unset($result->created_at);
				unset($result->updated_at);
			}
			
			$filepath = Excel::create($title, function($excel) use($results) {
		    $excel->sheet('Results', function($sheet) use($results) {
			    	$sheet->appendRow(array(
				    	"Order Number",
				    	"Item",
				    	"Quantity",	
				    	"Recipient",
				    	"Company",
						"Address 1",
				    	"Address 2",	
				    	"City",	
				    	"State",	
				    	"Post Code",	
				    	"Country",	
				    	"Phone",	
				    	"Ship Method",	
				    	"Recipient Email",	
				    	"Sender Email",	
				    	"Sender Email 2",	
				    	"Notes"
			    	));
			    foreach($results as $result){
				    $thisUser = \App\User::find($result->user_id);
				    
				    $sheet->appendRow(array(
					    "",
					    "",
					    "",
					    $thisUser['name'],
					    $thisUser['school_program_name'],
					    $thisUser['shipping_address_1'],
					    $thisUser['shipping_address_2'],
					    $thisUser['shipping_city'],
					    $thisUser['shipping_state'],
					    $thisUser['shipping_zip_code'],
					    $thisUser['country'],
					    $thisUser['phone'],
					    "",
					    $thisUser['email'],
					    "jeff@learnfresh.org",
					    "",
					    ""
					));
				  }
		    });
	    })->download('xls');
		}
	
		public function checkpointData($checkpoint)
		{
			$results = CheckpointResult::where("checkpoint_id",$checkpoint)->get();
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
	    })->download('xls');
		}
	
		public function shipping()
		{
			$orders = ShippingList::where('archived',0)->orderBy('created_at','desc')->get();
			
			return view("admin.shipping", [
				'orders' => $orders
			]);
		}
		
		public function deleteOrder(ShippingList $shippingList){
			$shippingList->delete();
			\Session::flash('alert-success', 'The order has been deleted!');
			return back();
		}

	
	
    public function users()
    {
	    $users = User::orderBy('created_at','desc')->get();
	    
	    Excel::create('Learn Fresh Users', function($excel) use($users) {
		    $excel->sheet('Users', function($sheet) use($users) {
			    $sheet->appendRow(array(
				    	"Last Logged In",
				    	"Tier",
					    "Name",
					    "Email",
					    "Phone",
					    "Estimated Students",
					    "Funded Region?",
					    "School Program Name",
					    "Site Address",
					    "Shipping Address",
					    "Billing Address",
					    "Country",
					    "Programs",
					    "Pretest Complete",
					    "# of Pretests Completed",
					    "Posttest Complete",
					    "# of Posttests Completed",
					    "Paid",
					    "Payment Reminders",
					    "Joined"
			    	));
			    foreach($users as $user){
							$students = array();
							foreach($user->students as $student){
								$students[] = $student->id;
							}
							$postassessmentCount = \App\Postassessment::whereIn("student_id", $students)->count();
							$programs = explode(",",$user->programs);	
							$programList = "";
							$max = count($programs);
							$count = 0;						
							foreach($programs as $key => $id){
									$thisProgram = \App\Program::where("id","=",$id)->first();
									$programList .= $thisProgram['title'];
									$count++;
									if ($count < $max){
										$programList .= ",";
									}
							}
							$paid = "";

							$preassessment = "";
							$postassessment = "";
	
							$site = $user->site_address_1."\n".$user->site_address_2."\n".$user->site_city .", ". $user->site_state." ".$user->site_zip_code;
							$shipping = $user->shipping_address_1."\n".$user->shipping_address_2."\n".$user->shipping_city .", ". $user->shipping_state." ".$user->shipping_zip_code;
							$billing = $user->billing_address_1."\n".$user->billing_address_2."\n".$user->billing_city .", ". $user->billing_state." ".$user->billing_zip_code;
							
							$funded = "";
							
							if($user->funded == 1){
								$funded = "Yes";
							} else {
								$funded = "No";
							}
							
							if($user->paid == 0){
								$paid = "Pending";
							} elseif($user->paid == 1) {
								$paid = "Yes";
							} elseif($user->paid == 2) {
								$paid = "N/A";
							}
							if($user->pre_assessment_complete == 0){
								$preassessment = "No";
							} else {
								$preassessment = "Yes";
							}
							if($user->post_assessment_complete == 0){
								$postassessment = "No";
							} else {
								$postassessment = "Yes";
							}
				    $sheet->appendRow(array(
					    \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans(),
					    	$user->account_level,
							$user->name,
							$user->email,
							$user->phone,
							$user->estimated_students,
							$funded,
							$user->school_program_name,
							$site,
							$shipping,
							$billing, 
							$user->country,
							$programList,
							$preassessment,
							\App\Preassessment::whereIn("student_id", $students)->count(),
							$postassessment,
							\App\Postassessment::whereIn("student_id", $students)->count(),			
							$paid,
							$user->payment_reminders,
							$user->created_at->setTimezone('America/Chicago')->diffForHumans()
						));
				  }
		    });
	    })->download('xls');
    }
    
    public function sortedUsers(Request $request)
    {
	    $users = array();
			switch($request->input('location')){
				case "checkpoint":
					if($request->input('query') == 'not-submitted') {
						User::chunk(200, function($u) use (&$users) {
							foreach($u as $user){
								$checkpoints = \App\CheckpointResult::where("user_id",$user->id)->where("archived",0)->get();
								if(count($checkpoints) == 0){
									$users[] = $user;
								}
							}
						});
					} else {
						User::chunk(200, function($u) use (&$users) {
							foreach($u as $user){
								$checkpoints = \App\CheckpointResult::where("user_id",$user->id)->where("archived",0)->get();
								if(count($checkpoints) > 0){
									$users[] = $user;
								}
							}
						});
					}
					break;
				case "rsvp":
					if($request->input('query') == 'no-rsvp') {
						User::chunk(200, function($u) use (&$users) {
							foreach($u as $user){
								$now = \Carbon\Carbon::now();
								$rsvpEvents = \App\Rsvp::where("user_id",$user->id)->get();
								$attended = false;
								foreach($rsvpEvents as $rsvp) {
									$event = \App\Event::find($rsvp->event_id);
									if($now < $event->event_date){
										if($attended == false){
										 $attended = true;
										}
									}
								}
								if($attended == false){
									$users[] = $user;
								}
							}
						});
					} else {
						User::chunk(200, function($u) use (&$users) {
							foreach($u as $user){
								$now = \Carbon\Carbon::now();
								$rsvpEvents = \App\Rsvp::where("user_id",$user->id)->get();
								$attended = false;
								foreach($rsvpEvents as $rsvp) {
									$event = \App\Event::find($rsvp->event_id);
									if($now < $event->event_date){
										if($attended == false){
										 $attended = true;
										 $users[] = $user;
										}
									}
								}
							}
						});
					}
					break;
				case "team":
					$zipcodes = "";
					if($request->input('query') == "gsw"){
						$zipcodes = FundedRegion::where('team',$request->input('query'))->orWhere('team','oak')->get();
					} else {
						$zipcodes = FundedRegion::where('team',$request->input('query'))->get();
					}
					$users = User::whereIn('site_zip_code', $zipcodes)->orWhereIn('shipping_zip_code',$zipcodes)->get();
					break;
				case "program":
					$users = User::where("programs","LIKE", "%".$request->input('query')."%")->get();
					break;
				case "inactive":
					if($request->input('query') == "all"){
						$users = User::where("last_login_at", "<=",\Carbon\Carbon::parse('2018/08/01')->toDateTimeString())->get();
					} else {
						$users = User::where("account_level", null)->where("last_login_at", ">=",\Carbon\Carbon::parse('2018/08/01')->toDateTimeString())->get();
					}
					break;
				default:
					$users = User::where($request->input('location'),'like', '%'.$request->input('query').'%')->get();
			}
		  
		  Excel::create('Learn Fresh Users', function($excel) use($users) {
		    $excel->sheet('Users', function($sheet) use($users) {
			    $sheet->appendRow(array(
				    	"Last Logged In",
				    	"Tier",
					    "Name",
					    "Email",
					    "Phone",
					    "Estimated Students",
					    "Funded Region?",
					    "School Program Name",
					    "Site Address",
					    "Shipping Address",
					    "Billing Address",
					    "Country",
					    "Programs",
					    "Pretest Complete",
					    "# of Pretests Completed",
					    "Posttest Complete",
					    "# of Posttests Completed",
					    "Paid",
					    "Payment Reminders",
					    "Joined"
			    	));
			    foreach($users as $user){
							$students = array();
							foreach($user->students as $student){
								$students[] = $student->id;
							}
							$postassessmentCount = \App\Postassessment::whereIn("student_id", $students)->count();
							$programs = explode(",",$user->programs);	
							$programList = "";
							$max = count($programs);
							$count = 0;						
							foreach($programs as $key => $id){
									$thisProgram = \App\Program::where("id","=",$id)->first();
									$programList .= $thisProgram['title'];
									$count++;
									if ($count < $max){
										$programList .= ",";
									}
							}
							$paid = "";

							$preassessment = "";
							$postassessment = "";
	
							$site = $user->site_address_1."\n".$user->site_address_2."\n".$user->site_city .", ". $user->site_state." ".$user->site_zip_code;
							$shipping = $user->shipping_address_1."\n".$user->shipping_address_2."\n".$user->shipping_city .", ". $user->shipping_state." ".$user->shipping_zip_code;
							$billing = $user->billing_address_1."\n".$user->billing_address_2."\n".$user->billing_city .", ". $user->billing_state." ".$user->billing_zip_code;
							
							$funded = "";
							
							if($user->funded == 1){
								$funded = "Yes";
							} else {
								$funded = "No";
							}
							
							if($user->paid == 0){
								$paid = "Pending";
							} elseif($user->paid == 1) {
								$paid = "Yes";
							} elseif($user->paid == 2) {
								$paid = "N/A";
							}
							if($user->pre_assessment_complete == 0){
								$preassessment = "No";
							} else {
								$preassessment = "Yes";
							}
							if($user->post_assessment_complete == 0){
								$postassessment = "No";
							} else {
								$postassessment = "Yes";
							}
				    $sheet->appendRow(array(
					    \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login_at))->diffForHumans(),
					    	$user->account_level,
							$user->name,
							$user->email,
							$user->phone,
							$user->estimated_students,
							$funded,
							$user->school_program_name,
							$site,
							$shipping,
							$billing, 
							$user->country,
							$programList,
							$preassessment,
							\App\Preassessment::whereIn("student_id", $students)->count(),
							$postassessment,
							\App\Postassessment::whereIn("student_id", $students)->count(),			
							$paid,
							$user->payment_reminders,
							$user->created_at->setTimezone('America/Chicago')->diffForHumans()
						));
				  }
		    });
	    })->download('xls');
	    
	    return back();
    }
    
    public function attendees(Event $event)
    {
	    $rsvps = Rsvp::where('event_id',$event->id)->get();
	    
	    $attendees = [];
	    $finalAttendees = [];
	    
	    foreach($rsvps as $t){
		    if($t->user_id){
		    $user = User::find($t->user_id);
		    $attendees[] = array($user->school_program_name,$user->name,$user->email,$user->phone,"",$t->students,$t->additional_guests);
		    } else {
			   $attendees[] = array($t->school_program_name,$t->name,$t->email,$t->phone,"",$t->students,$t->additional_guests);
		    }
	    }
	    
	    foreach($attendees as $attendee) {
		    $a = implode(",", $attendee);
		    $finalAttendees[] = explode(",", $a);
	    }
	    
	    
	    $sheetTitle = $event->title . " Attendees";
	    
	    Excel::create($sheetTitle, function($excel) use($rsvps) {
		    $excel->sheet('Users', function($sheet) use($rsvps) {
			    $count = 1;
			    foreach($rsvps as $t){
				    if($t->user_id){
				    $user = User::find($t->user_id);
				    $students = explode(",", $t->students);
				    $sheet->appendRow(array(
					    $count,
					    $user->school_program_name,
					    $user->name,
					    $user->email,
					    $user->phone,
					    "",
					    (isset($students[0])) ? $students[0] : "",
					    (isset($students[1])) ? $students[1] : "",
					    $t->additional_guests
				    ));
				    } else {
					$students = explode(",", $t->students);
				    $sheet->appendRow(array(
					    $count,
					    $t->school_program_name,
					    $t->name,
					    $t->email,
					    $t->phone,
					    "",
					    (isset($students[0])) ? $students[0] : "",
					    (isset($students[1])) ? $students[1] : "",
					    $t->additional_guests
				    ));
				    }
				    $count++;
				    if(count($students) > 2){
					    $resetCount = 0;
					    $newRow = array("","","","","","");
					    unset($students[0]);
					    unset($students[1]);
					    foreach($students as $s){
						    $newRow[] = $s;
						    $resetCount++;
						    if($resetCount == 2){
							    $sheet->appendRow($newRow);
							    $newRow = array("","","","","","");
							    $resetCount = 0;
						    }
					    }
				    }
				    $sheet->appendRow(array("","","","","",""));
			    }
			    
			    $sheet->prependRow(array(
				    "#",
				    "School Name",
				    "Educator Name",
				    "Educator Email",
				    "Educator Phone",
				    "Assigned Team",
				    "Student Name 1",
				    "Student Name 2",
				    "Additional Guests"
			    ));
					
		    });
	    })->download('xls');
    }
    
    public function downloadOrders()
    {
	    $orders = ShippingList::orderby('created_at','desc')->get();
	    
	    foreach($orders as $order){
	    	unset($order->id);
	    	unset($order->created_at);
	    	unset($order->updated_at);
	    	unset($order->archived);
	    }
	    
	    Excel::create("Orders", function($excel) use($orders) {
		    $excel->sheet('Orders', function($sheet) use($orders) {
			   
			    $sheet->fromArray($orders, null, 'A1', false, false);
			    $sheet->prependRow(array(
						'Order Number',
						'Item #',
						'Quantity',
						'Recipient',
						'Company',
						'Address 1',
						'Address 2',
						'City',
						'State',
						'Post Code',
						'Country',
						'Phone',
						'Ship Method',
						'Recipient Email',
						'Sender Email',
						'Sender Email 2',
						'Notes'
					));
		    });
	    })->download('xls');
    }
}
