<?php

namespace App\Http\Controllers;

use App\User;
use App\TrainingCode;
use App\PurchaseOrder;
use App\Application;
use App\CompletedWeek;
use App\FundedRegion;
use App\Week;
use App\SubAdmin;
use App\Rsvp;
use App\Championship;
use App\ShippingList;
use App\Preassessment;
use App\Postassessment;
use App\Mail\EventCommunication;
use App\Mail\MarkPaid;
use App\Mail\InviteUser;
use App\Notifications\WeeklyTipLive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
	public function convertUsers()
	{
		User::chunk(100, function($users) {
			foreach($users as $user){
				if($user->account_level == "bronze"){
					$user->account_level = 1;
					$user->save();
				}
				if($user->account_level == "silver"){
					$user->account_level = 1;
					$user->save();
				}
				if($user->account_level == "gold"){
					$user->account_level = 2;
					$user->save();
				}
			}
		});
	}
	
	public function trainingCodes()
	{
		$trainingCodes = TrainingCode::where("expiration",">",\Carbon\Carbon::now())->get();
		
		return view("admin.training-codes",[
			"codes" => $trainingCodes
		]);
	}
	
	public function trainingCodesDelete(TrainingCode $trainingCode)
	{
		$trainingCode->delete();
		
		\Session::flash("alert-success", "The code has been deleted.");
		return back();
	}
	
	public function trainingCodesNew(Request $request)
	{
		$expiration = \Carbon\Carbon::now()->addDays(14);
		if($request->input('expiration') != ""){
			$expiration = \Carbon\Carbon::parse($request->input('expiration'));
		}
		
		TrainingCode::create([
			"code" => strtolower($request->input('code')),
			"expiration" => $expiration
		]);
		
		\Session::flash("alert-success", "The code has been added and is now active");
		return back();
	}
	
	public function updatePurchaseOrder(PurchaseOrder $purchaseOrder)
	{
		$poUser = User::where('id',$purchaseOrder->user_id)->first();
		$poUser->paid = 1;
		$poUser->save();
		
		$purchaseOrder->paid = 1;
		$purchaseOrder->save();
		
		\Session::flash("alert-success", "The purchase order has been marked as paid!");
		return back();
	}
	
	public function purchaseOrders()
	{
		$pos = PurchaseOrder::where("paid",0)->orderBy('created_at','desc')->get();
		return view("admin.pos", [
			"pos" => $pos
		]);
	}
	
	public function inviteAdmin(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
		]);
		
		$password = str_random(8);
		
		$user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($password),
            'admin' => 1
        ]);
        
        Mail::to($request->input("email"))->send(new InviteUser($request->input("name"),$request->input("email"),$password));
        
        \Session::flash('alert-success', "The person has been invited to be an administrator!");
        return back();
	}
	
	public function applications()
	{
		$applications = Application::all();
		return view("admin.applications", [
			"applications" => $applications
		]);
	}
	
	public function editUser(User $user)
	{
		return view("admin.edit-user", [
			"user" => $user
		]);
	}
	
	public function updateUser(User $user, Request $request)
	{
		$user->update($request->all());
    		
		\Session::flash("alert-success", "The user has been updated!");
		return back();
	}
	
	public function userAssessments(User $user)
	{
		$pretests = Preassessment::where('school_program_name', $user->school_program_name)->get();
		$posttests = Postassessment::where('school_program_name', $user->school_program_name)->get();
		$sorting[] = ["school_program_name", "=", $user->school_program_name];
		$columns = \Schema::getColumnListing('preassessments');
		$all = Preassessment::where($sorting)->orderBy('created_at','desc')->get();
		
		return view("admin.user-tests", [
			"pretests" => $pretests,
			"posttests" => $posttests,
			"program" => $user,
			"columns" => $columns,
			"all" => $all
		]);
	}
	
	public function searchUsers(Request $request)
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
				$users = User::whereIn('site_zip_code', $zipcodes)->orWhereIn('shipping_zip_code',$zipcodes)->where('admin',0)->get();
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
		
		$subAdmins = User::where('sub_admin','=',1)->get();
		
		return view("admin.user-list", [
			"users" => $users,
			"subs" => $subAdmins
		]);
	}
	
	public function allUserList()
	{
		$users = User::orderBy('created_at','desc')->get();
		$subAdmins = User::where('sub_admin','=',1)->get();
		
		return view("admin.user-list", [
			'users' => $users,
			"subs" => $subAdmins
		]);
	}
	
	public function editAttendee(Rsvp $rsvp)
	{
		return view("admin.events.edit-attendee", [
			"attendee" => $rsvp
		]);
	}
	
	public function deleteAttendee(Rsvp $rsvp)
	{
		$rsvp->delete();
		\Session::flash('alert-success', "The attendee has been removed!");
		return back();
	}
	
	public function updateAttendee(Rsvp $rsvp, Request $request)
	{
		$rsvp->students = $request->input('students');
		$rsvp->additional_guests = $request->input('additional_guests');
		$rsvp->shirt_sizes = $request->input('shirt_sizes');
		$rsvp->update();
		\Session::flash('alert-success', "The attendee has been updated!");
		return redirect("/event/" . $rsvp->event_id . "/rsvp-list");
	}
	
	public function makeSubAdmin(User $user)
	{
		$user->sub_admin = 1;
		$user->save();
		\Session::flash('alert-success', 'The user is now a general manager.');
		return back()->withInput();
	}
	
	public function championship()
	{
		$championship = Championship::first();
		return view("admin.championship" ,[
			"championship" => $championship
		]);
	}
	
	public function advanceWeeks()
	{
		$users = User::where('admin',0)->where('paid','!=',0)->where('pre_assessment_complete','=',1)->get();
    
    foreach($users as $user){
      $finishedWeek = CompletedWeek::where("user_id",$user->id)->orderBy('created_at','desc')->first();
      $lastWeek = 1;
      
      if($finishedWeek){
      	$lastWeek = (int)$finishedWeek->week_number;
      	$lastWeek++;
      	CompletedWeek::create([
	        "user_id" => $user->id,
	        "week_number" => $lastWeek,
	        "notified" => 0
        ]);
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
	}
	
	public function reopenPosttest(User $user)
	{
		$user->post_assessment_complete = 0;
		$user->save();
		\Session::flash("alert-success", "The post-test has been reopened for the user!");
  	return back()->withInput();
	}
	
	public function completePosttest(User $user)
	{
		$user->post_assessment_complete = 1;
		$user->save();
		\Session::flash("alert-success", "The post-test has been completed for the user!");
  	return back()->withInput();
	}
	
	public function reopenPretest(User $user)
	{
		$user->pre_assessment_complete = 0;
		$user->save();
		\Session::flash("alert-success", "The pretest has been reopened for the user!");
  	return back()->withInput();
	}
	
	public function completePretest(User $user)
	{
		$user->pre_assessment_complete = 1;
		$user->save();
		
		$count = ceil(count($user->students)/4);
		if($count > 8){
				$count = 8;    
	    }
	    
	    if($count == 0){
		    $count = 1;
	    }
	    
		$quantity = $count;
	    $cards = ceil($count/2);
	    
		if($cards == 0){
			$cards++;
		}
		
		$stickers = $quantity * 2;
		
		$lastOrder = ShippingList::orderby('created_at','desc')->first();		
		$orderNumber = \Carbon\Carbon::now()->format("Ymd") . "001";	
		if($lastOrder){
			if($orderNumber <= $lastOrder->order_number){
				$orderNumber = $lastOrder->order_number + 1;
			}
		}
		
		$shippingMethod = "Fedex Ground";
		
		if(!$user->country || $user->country == null || $user->country == ""){
			$user->country = "USA";
			$user->save();
		}
		
		
		if($user->country != "USA"){
			$shippingMethod = "Fedex International";
		}
    
		$games = $quantity;
		$cards = $cards;
		
		$shippingName = $user->name;
		if($user->shipping_name){
			$shippingName = $user->shipping_name;
		}
		
		$shipStation = new \LaravelShipStation\ShipStation(getenv('SS_KEY'), getenv('SS_SECRET'));
	
		$address = new \LaravelShipStation\Models\Address();
		
		$address->name = $shippingName;
	    $address->street1 = $user->shipping_address_1;
	    $address->street2 = $user->shipping_address_2;
	    $address->city = $user->shipping_city;
	    $address->state = $user->shipping_state;
	    $address->postalCode = $user->shipping_zip_code;
	    $address->country = $user->country;
	    $address->phone = $user->phone;
		
		if(!$user->isDemo()){
	    
    
	    ShippingList::create([
		    "order_number" => $orderNumber,
		    "item" => 48720,
		    "quantity" => $games,
		    "recipient" => $shippingName,
		    "company" => $user->school_program_name,
		    "address_1" => $user->shipping_address_1,
		    "address_2" => $user->shipping_address_2,
		    "city" => $user->shipping_city,
		    "state" => $user->shipping_state,			    
		    "post_code" => $user->shipping_zip_code,
		    "country" => $user->country,
		    "ship_method" => $shippingMethod,
		    "recipient_email" => $user->email
		    ]);
		    
		    ShippingList::create([
		    "order_number" => $orderNumber,
		    "item" => 48826,
		    "quantity" => $cards,
		    "recipient" => $shippingName,
		    "company" => $user->school_program_name,
		    "address_1" => $user->shipping_address_1,
		    "address_2" => $user->shipping_address_2,
		    "city" => $user->shipping_city,
		    "state" => $user->shipping_state,
		    "post_code" => $user->shipping_zip_code,
		    "country" => $user->country,
		    "ship_method" => $shippingMethod,
		    "recipient_email" => $user->email
		    ]);
		    
		    // Shipstation
		    
		    $item = new \LaravelShipStation\Models\OrderItem();

	    $item->sku = 48720;
	    $item->name = "Game";
	    $item->quantity = $games;
	    $item->unitPrice = "0.00";
	    
	    $order->items[] = $item;
	    
	    $item = new \LaravelShipStation\Models\OrderItem();

	    $item->sku = 48826;
	    $item->name = "Cards";
	    $item->quantity = $cards;
	    $item->unitPrice = "0.00";
	    
	    $order->items[] = $item;
		    
		    if($user->shipping_state == "UT"){
 		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51011,
  			    "quantity" => $games,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,			    
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51012,
  			    "quantity" => $cards,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51011;
		    $item->name = "Utah Items";
		    $item->quantity = $games;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
		    
		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51012;
		    $item->name = "Utah Items";
		    $item->quantity = $cards;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
 		  }
 		  
 		  if($user->shipping_state == "WI"){
 		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51021,
  			    "quantity" => $games,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,			    
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51022,
  			    "quantity" => $cards,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51023,
  			    "quantity" => $games,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,			    
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51021;
		    $item->name = "Wisconsin Items";
		    $item->quantity = $games;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
		    
		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51022;
		    $item->name = "Wisconsin Items";
		    $item->quantity = $cards;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
		    
		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51023;
		    $item->name = "Wisconsin Items";
		    $item->quantity = $games;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
   		    
 		  }
	    
	    if($user->shipping_state == "MI"){
		    
  		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51001,
  			    "quantity" => $games,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,			    
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51002,
  			    "quantity" => $cards,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    ShippingList::create([
  			    "order_number" => $orderNumber,
  			    "item" => 51003,
  			    "quantity" => $games,
  			    "recipient" => $shippingName,
  			    "company" => $user->school_program_name,
  			    "address_1" => $user->shipping_address_1,
  			    "address_2" => $user->shipping_address_2,
  			    "city" => $user->shipping_city,
  			    "state" => $user->shipping_state,
  			    "post_code" => $user->shipping_zip_code,
  			    "country" => $user->country,
  			    "ship_method" => $shippingMethod,
  			    "recipient_email" => $user->email
   		    ]);
   		    
   		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51001;
		    $item->name = "Minnesota Items";
		    $item->quantity = $games;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
		    
		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51002;
		    $item->name = "Minnesota Items";
		    $item->quantity = $cards;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
		    
		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->sku = 51003;
		    $item->name = "Minnesota Items";
		    $item->quantity = $games;
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
		    
	    }
	    
	    $laZips = array(
				"90016",
				"90002",
				"90061",
				"90002",
				"90002",
				"90003",
				"90002",
				"90003",
				"90002",
				"90002",
				"90061",
				"90061",
				"90059",
				"90061",
				"90002",
				"90002",
				"91306",
				"91306",
				"91306",
				"91306",
				"91351",
				"91306",
				"91324",
				"90016",
				"90002",
				"90061",
				"90003",
				"90059",
				"91306",
				"91351",
				"91324"
			);
			
			if(in_array($user->shipping_zip_code, $laZips)){
				ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51031,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51032,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51033,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51034,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51035,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51036,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51031;
			    $item->name = "Los Angeles Items";
			    $item->quantity = $games;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51032;
			    $item->name = "Los Angeles Items";
			    $item->quantity = $cards;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51033;
			    $item->name = "Los Angeles Items";
			    $item->quantity = $games;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51034;
			    $item->name = "Los Angeles Items";
			    $item->quantity = $games;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51035;
			    $item->name = "Los Angeles Items";
			    $item->quantity = $cards;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51036;
			    $item->name = "Los Angeles Items";
			    $item->quantity = $games;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			}
			
			$philZips = FundedRegion::where('team','phi')->get()->toArray();
			
			if(in_array($user->site_zip_code, $philZips) || in_array($user->shipping_zip_code, $philZips)){
				ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51041,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 51042,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => $user->school_program_name,
				    "address_1" => $user->shipping_address_1,
				    "address_2" => $user->shipping_address_2,
				    "city" => $user->shipping_city,
				    "state" => $user->shipping_state,			    
				    "post_code" => $user->shipping_zip_code,
				    "country" => $user->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => $user->email
			    ]);
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51041;
			    $item->name = "Philadelphia Items";
			    $item->quantity = $cards;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			    
			    $item = new \LaravelShipStation\Models\OrderItem();
	
			    $item->sku = 51042;
			    $item->name = "Philadelphia Items";
			    $item->quantity = $games;
			    $item->unitPrice = "0.00";
			    
			    $order->items[] = $item;
			}
		    
		  }
		  
		$order = new \LaravelShipStation\Models\Order();

    $order->orderNumber = $orderNumber;
    $order->orderDate = \Carbon\Carbon::now()->toDateString();
    $order->orderStatus = 'awaiting_shipment';
    $order->amountPaid = '0.00';
    $order->taxAmount = '0.00';
    $order->shippingAmount = '0.00';
    $order->billTo = $address;
    $order->shipTo = $address;	    
	
	$shipStation->orders->post($order, 'createorder');
		
		\Session::flash("alert-success", "The pretest has been completed for the user! Games will be shipped.");
  	return back()->withInput();
	}
	
	public function updatePayment(User $user)
	{
		$user->paid = 2;
		$user->save();
		
		\Mail::to($user->email)->send(new MarkPaid());
		
		\Session::flash("alert-success", "The user has been updated!");
  	return redirect('/admin/users')->withInput();
	}
	
	public function updateChampionship(Request $request)
	{
		$championship = Championship::first();
		$championship->update($request->all());
		
		if($request->file('qualify_image')){	    
  		$file = $request->file('qualify_image');
  		$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->move(base_path() . '/public/championship-images/', $fileName);
			$uploadedFile = "/championship-images/" . $fileName;
			$championship->qualify_image = $uploadedFile;
  	}
  	
  	if($request->file('event_details_image')){	    
  		$file2 = $request->file('event_details_image');
  		$fileName2 = time() . '2.' . $file2->getClientOriginalExtension();
			$file2->move(base_path() . '/public/championship-images/', $fileName2);
			$uploadedFile2 = "/championship-images/" . $fileName2;
			$championship->event_details_image = $uploadedFile2;
  	}
  	
  	$championship->save();
  	
  	\Session::flash("alert-success", "The championship details have been updated!");
  	return redirect("/home");
	}
	
  public function index()
  {
  	return view('admin.index');
  }
  
  public function deleteUser(User $user){
	  $user->delete();
	  \Session::flash("alert-success", "The user has been deleted.");
  	return back();
  }
  
  public function allUsers()
  {
	  $users = User::where('admin','=',0)->orderBy('created_at','desc')->paginate(25);
	  $subAdmins = User::where('sub_admin','=',1)->get();
	  
	  return view('admin.users', [
		  "users" => $users,
		  "subs" => $subAdmins
	  ]);
  }
  
  public function admins()
  {
	  $users = User::where('admin','=',1)->orderBy('created_at','desc')->paginate(25);
	  
	  return view('admin.users.admins', [
		  "users" => $users
	  ]);
  }
  
  public function addToSubAdmin(Request $request, User $user){
	  SubAdmin::create([
		  "admin" => $request->input("admin"),
		  "user" => $user->id
	  ]);
	  \Session::flash("alert-success","The user has been added to a general manager!");
	  return back()->withInput();
  }
  
  public function emailAllUsers()
  {
	  return view('admin.email-users');
  }
  
  public function emailSpecificUsers(Request $request)
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
							$checkpoints = \App\CheckpointResult::where("user_id",$user->id)->where("created_at",">=",\Carbon\Carbon::parse('2018/08/01')->toDateTimeString())->get();
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
	  return view('admin.email-specific-users', [
		  "users" => $users
	  ]);
  }
  
  public function sendEmailSpecificUsers(Request $request)
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
	  
	  foreach($users as $user) {
		  if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){
	    	\Mail::to($user->email)->send(new EventCommunication($user,$request->input('subject'), $request->input('message')));
	    }
	  }
	  
	  \Session::flash("alert-success", "Message(s) has been successfully sent!");
	  
	  return redirect('/admin/users');
  }
  
  public function sendEmailAllUsers(Request $request)
  {
	  $users = User::all();
	  
	  foreach($users as $user) {
		  if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){
	    	\Mail::to($user->email)->send(new EventCommunication($user,$request->input('subject'), $request->input('message')));
	    }
	  }
	  
	  \Session::flash("alert-success", "Message(s) has been successfully sent!");
	  
	  return redirect('/admin/users');
  }
  
  public function sortUsers(Request $request)
  {
	  $allusers = User::all();
	  $subAdmins = User::where('sub_admin','=',1)->get();
	  
	  $sorting = array();
	  $currentWeekUsers = array();
	  
	  if($request->input('currentWeek') != 'null') {
		  if($request->input('currentWeek') == "pre") {
			  $sorting[] = ["pre_assessment_complete", "=", 0];
		  } elseif($request->input('currentWeek') == "post") {
			  foreach($allusers as $u){
				  $current = \App\CompletedWeek::where('user_id',$u->id)->orderBy('created_at','desc')->first();
				  if($current){
					  if($current['week_number'] == 12){
						  $currentWeekUsers[] = $u->id;
					  }
				  }
			  }
		  } elseif($request->input('currentWeek') == "completed") {
			  $sorting[] = ["post_assessment_complete", "=", 1];
		  } else {
			  $thisWeek = (int)$request->input('currentWeek');
			  foreach($allusers as $u){
				  if($u->pre_assessment_complete == 1){
					  $current = \App\CompletedWeek::where('user_id',$u->id)->orderBy('created_at','desc')->first();
					  if($current){
						  if((int)$current['week_number'] == $thisWeek) {
							  $currentWeekUsers[] = $u->id;
						  }
					  }
				  }
			  }
		  }
	  }
	  
	  if($request->input('city') != 'null')
	  	$sorting[] = ["shipping_city", "=", $request->input('city')];
	  	
	  if($request->input('state') != 'null')
	  	$sorting[] = ["shipping_state", "=", $request->input('state')];
	  	
	  if($request->input('zip') != 'null')
	  	$sorting[] = ["shipping_zip_code", "=", $request->input('zip')];
	  	
	  if($request->input('country') != 'null')
	  	$sorting[] = ["country", "=", $request->input('country')];
	  	
	  if($request->input('team') != 'null')
	  	$sorting[] = ["favorite_team", "=", $request->input('team')];
	  
	  if($request->input('first_year') != 'null')
	  	$sorting[] = ["first_year", "=", (int)$request->input('first_year')];
	  	
	  if($request->input('pre_assessment_complete') != 'null')
	  	$sorting[] = ["pre_assessment_complete", "=", (int)$request->input('pre_assessment_complete')];
	  	
	  if($request->input('post_assessment_complete') != 'null')
	  	$sorting[] = ["post_assessment_complete", "=", (int)$request->input('post_assessment_complete')];
	  
	  if($request->input('paid') != 'null')
	  	$sorting[] = ["paid", "=", (int)$request->input('paid')];
	  	
	  if($request->input('payment_reminders') != 'null')
	  	$sorting[] = ["payment_reminders", "=", (int)$request->input('payment_reminders')];
	  	
	  if($request->input('program') != 'null')
	  	$sorting[] = ["programs", "LIKE", "%" . $request->input('program') . "%"];
	  	
	  if(count($currentWeekUsers) > 0) {
		  if(count($sorting) > 0){
			  $users = User::where(function($q) use ($sorting,$currentWeekUsers){ $q->where($sorting)->whereIn('id',$currentWeekUsers); })->paginate(25);
		  } else {		  	
		  	$users = User::whereIn('id',$currentWeekUsers)->paginate(25);
		  }
	  } else {
	  	$users = User::where($sorting)->paginate(25);
	  }
	  
	  return view('admin.sorted', [
		  "users" => $users,
	    "allusers" => $allusers,
	    "subs" => $subAdmins
	  ]);
  }
  
  public function emailSortedUsers(Request $request)
  {
	  $allusers = User::all();
		$sorting = array();
		
		$currentWeekUsers = array();
	  
	  if($request->input('currentWeek') != 'null') {
		  if($request->input('currentWeek') == "pre") {
			  $sorting[] = ["pre_assessment_complete", "=", 0];
		  } elseif($request->input('currentWeek') == "post") {
			  foreach($allusers as $u){
				  $current = \App\CompletedWeek::where('user_id',$u->id)->orderBy('created_at','desc')->first();
				  if($current){
					  if($current['week_number'] == 12){
						  $currentWeekUsers[] = $u->id;
					  }
				  }
			  }
		  } elseif($request->input('currentWeek') == "completed") {
			  $sorting[] = ["post_assessment_complete", "=", 1];
		  } else {
			  $thisWeek = (int)$request->input('currentWeek');
			  foreach($allusers as $u){
				  if($u->pre_assessment_complete == 1){
					  $current = \App\CompletedWeek::where('user_id',$u->id)->orderBy('created_at','desc')->first();
					  if($current){
						  if((int)$current['week_number'] == $thisWeek) {
							  $currentWeekUsers[] = $u->id;
						  }
					  }
				  }
			  }
		  }
	  }

		
		if($request->input('city') != 'null')
	  	$sorting[] = ["shipping_city", "=", $request->input('city')];
	  	
	  if($request->input('state') != 'null')
	  	$sorting[] = ["shipping_state", "=", $request->input('state')];
	  	
	  if($request->input('zip') != 'null')
	  	$sorting[] = ["shipping_zip_code", "=", $request->input('zip')];
	  	
	  if($request->input('country') != 'null')
	  	$sorting[] = ["country", "=", $request->input('country')];
	  	
	  if($request->input('team') != 'null')
	  	$sorting[] = ["favorite_team", "=", $request->input('team')];
	  
	  if($request->input('first_year') != 'null')
	  	$sorting[] = ["first_year", "=", (int)$request->input('first_year')];
	  	
	  if($request->input('pre_assessment_complete') != 'null')
	  	$sorting[] = ["pre_assessment_complete", "=", (int)$request->input('pre_assessment_complete')];
	  	
	  if($request->input('post_assessment_complete') != 'null')
	  	$sorting[] = ["post_assessment_complete", "=", (int)$request->input('post_assessment_complete')];
	  
	  if($request->input('paid') != 'null')
	  	$sorting[] = ["paid", "=", (int)$request->input('paid')];
	  	
	  if($request->input('payment_reminders') != 'null')
	  	$sorting[] = ["payment_reminders", "=", (int)$request->input('payment_reminders')];
	  	
	  if($request->input('program') != 'null')
	  	$sorting[] = ["programs", "LIKE", "%" . $request->input('program') . "%"];
			
		if(count($currentWeekUsers) > 0) {
		  if(count($sorting) > 0){
			  $users = User::where(function($q) use ($sorting,$currentWeekUsers){ $q->where($sorting)->whereIn('id',$currentWeekUsers); })->paginate(25);
		  } else {		  	
		  	$users = User::whereIn('id',$currentWeekUsers)->paginate(25);
		  }
	  } else {
	  	$users = User::where($sorting)->paginate(25);
	  }
		
		foreach($users as $user){
			if(filter_var($user->email, FILTER_VALIDATE_EMAIL)){
				\Mail::to($user->email)->send(new EventCommunication($user,$request->input('subject'), $request->input('message')));
			}
		}
    
    \Session::flash("alert-success", "Message(s) has been successfully sent!");
    
    return back();
  }
  
  public function email(User $user)
  {
    return view('admin.email-user', [
	    "user" => $user
    ]);
  }
  
  public function sendEmail(User $user, Request $request)
  {
	  $message = "<p>From " . \Auth::user()->name . " (" . \Auth::user()->email . ")</p>" . $request->input('message');
	  \Mail::to($user->email)->send(new EventCommunication($user,$request->input('subject'), $message));
    
    \Session::flash("alert-success", "Message has been successfully sent to " . $user->name . "!");
    
    return redirect('/admin/users');
  }
}
