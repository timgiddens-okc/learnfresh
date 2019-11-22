<?php

namespace App\Http\Controllers;

use App\User;
use App\Application;
use App\TrainingCode;
use App\PurchaseOrder;
use App\FundedRegion;
use App\Program;
use App\Student;
use App\Checkpoint;
use App\Rsvp;
use App\SubAdmin;
use App\Preassessment;
use App\Postassessment;
use App\CheckpointResult;
use App\CompletedWeek;
use App\FinishedSeason;
use App\ShippingList;
use App\Mail\PaymentReminder;
use App\Mail\SendPurchaseOrder;
use Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

		public function addStudent(Request $request)
		{
			$student = new Student([
				'name' => $request->input('name'),
				'user_id' => \Auth::user()->id
			]);
			
			\Auth::user()->students()->save($student);
			
			\Session::flash('alert-success','The student has been added.');
			return back();
		}

		public function myApplicants()
		{
			$applications = Application::where('educator_id',\Auth::user()->id)->orderBy('team_region')->orderBy('student_name')->get();
	    
		    return view("applications", [
			    "applications" => $applications
		    ]);
		}

		public function checkpoints()
		{
			$checkpoints = Checkpoint::where("archived",0)->where('open_date','>',\Carbon\Carbon::now())->orderBy('open_date')->get();
			
			return view("checkpoints", [
				"checkpoints" => $checkpoints
			]);
		}
	
		public function pretest()
		{
			$students = \Auth::user()->students;
			return view("pretest", [
				"students" => $students
			]);
		}
		
		public function posttest()
		{
			$students = \Auth::user()->students;
			return view("posttest", [
				"students" => $students
			]);
		}
	
		public function myClass()
		{
			$students = \Auth::user()->students;
			return view("my-class", [
				"students" => $students
			]);
		}
	
		public function demo()
		{
			return view('demo.register');
		}
	
		public function newSeason()
		{
			// Reset assessments
			\Auth::user()->pre_assessment_complete = 0;
			\Auth::user()->post_assessment_complete = 0;
			\Auth::user()->save();
			
			// Delete completed weeks
			CompletedWeek::where('user_id','=',\Auth::user()->id)->delete();
			
			// Archive assessments
			$students = \Auth::user()->students;
			
			$title = md5(time());
			
			$filepath = Excel::create($title, function($excel) use($students) {
		    $excel->sheet('Pre-tests', function($sheet) use($students) {
			    foreach($students as $student){
				    $spreadsheetData = array();
				    $spreadsheetData[] = $student->name;
				    
				  	$results = \App\Preassessment::where('student_id',$student->id)->get()->toArray();
				  	foreach ($results as $a){
							foreach ($a as $key => $t){
								if($key != 'id' && $key != 'created_at' && $key != 'updated_at' && $key != 'student_id'){
									$spreadsheetData[] = $t;
								}
							}
						}
						
				    $sheet->prependRow($spreadsheetData);
			    }
		    });
		    $excel->sheet('Post-tests', function($sheet) use($students) {
			    foreach($students as $student){
				    $spreadsheetData = array();
				    $spreadsheetData[] = $student->name;
				    
				  	$results = \App\Postassessment::where('student_id',$student->id)->get()->toArray();
				  	foreach ($results as $a){
							foreach ($a as $key => $t){
								if($key != 'id' && $key != 'created_at' && $key != 'updated_at' && $key != 'student_id'){
									$spreadsheetData[] = $t;
								}
							}
						}
						
				    $sheet->prependRow($spreadsheetData);
			    }
		    });
	    })->store('xls', false, true);
	    
	    \Auth::user()->students()->delete();
	    
	    FinishedSeason::create([
		    "user_id" => \Auth::user()->id,
		    "file" => "/storage/exports/" . $filepath['file']
	    ]);
	    
	    \Session::flash("alert-success", "You have started a new season!");
	    return redirect("/home");
			
		}
	
		public function generalManager()
		{
			$siteIds = array();
			$su = SubAdmin::where("admin","=",\Auth::user()->id)->get();
			foreach($su as $u){
				$thisUser = User::select('id')->where('id',$u->user)->first();
				$siteIds[] = $thisUser['id'];
			}
			$sites = User::whereIn('id',$siteIds)->get();
			return view("sub-admin.index", [
				"sites" => $sites
			]);
		}
	
		public function editStudent(Student $student)
		{
			return view("edit-student",[
				"student" => $student
			]);
		}
		
		public function deleteStudent(Student $student)
		{
			$student->delete();
			\Session::flash("alert-success", "The student has been deleted!");
			return redirect("/settings");
		}
		
		public function updateStudent(Request $request, Student $student)
		{
			$this->validate($request, [
				"name" => "required"
			]);
			
			$student->update($request->all());
			
			\Session::flash("alert-success", "The student has been updated!");
			return redirect("/settings");
		}
	
    public function update(Request $request)
    { 
	    	$programs = $request->input('programs');
	    	if($programs){
	    	$programs = implode(",",$programs);
	    	} else {
		    	$programs = null;
	    	}
    		$request->merge(['programs' => $programs]);
	    
    		\Auth::user()->update($request->all());
    		
    		\Session::flash("alert-success", "Your settings have been updated!");
    		return back();
    }
    
    public function finishRegister()
    {
	    if(\Auth::check() && (\Auth::user()->school_program_name == null || \Auth::user()->school_program_name == "")){
	    	return view('auth.register-site');
	    }
	    return redirect('/home');
    }
    
    public function registerSite(Request $request)
    {
	    
	    if(strip_tags(strtolower($request->input('discount'))) != "lf100" && strip_tags(strtolower($request->input('discount'))) != "lf50" && $request->input('discount') != null){
		    \Session::flash("alert-danger", "That discount code is not valid. Please try again.");
		    return back()->withInput();
	    }
	    
	    $programs = $request->input('programs');
	    if($programs){
	    $programs = implode(",",$programs);    		
	    } else {
		    $programs = null;
	    }
    	$request->merge(['programs' => $programs]);
	    
	    \Auth::user()->update($request->except(['discount']));
	    
	    
	    
	    if(strip_tags(strtolower($request->input('discount'))) == "lf100") {
		    \Auth::user()->discount_code = "LF100";
		    \Auth::user()->paid = 2;
		    \Auth::user()->save();
		    \Session::flash("alert-success", "The discount has been applied! Welcome to the Learn Fresh Coaches Association!");
	    }
	    
	    if(strip_tags(strtolower($request->input('discount'))) == "lf50") {
		    \Auth::user()->discount_code = "LF50";
		    \Auth::user()->save();
		    \Auth::user()->save();
		    \Session::flash("alert-success", "The discount has been applied!");
	    }
	    
	    return redirect("/home");
    }
    
    public function settings()
    {
	    $students = \Auth::user()->students;	
	    $finishedSeasons = FinishedSeason::where('user_id','=',\Auth::user()->id)->orderBy('created_at','desc')->get();
	    
	    $programs = Program::all();
	    
	    $subscribed = [];
	    
	    $programIds = explode(",", \Auth::user()->programs);
	    
	    foreach($programIds as $id) {
		    $subscribed[] = $id;
	    }
	    
	    $createdAt = new Carbon(\Auth::user()->created_at);
	    $now = Carbon::now()->timezone('America/Chicago');
	    
			$weekNumber = floor($createdAt->diff($now)->days / 7) + 1;
			
			if ($weekNumber > 12) {
				$weekNumber = 12;
			}
			
			$checkpoints = CheckpointResult::where('user_id',\Auth::user()->id)->orderBy('created_at','desc')->get();
	    
			return view('settings', [
				'students' => $students,
				'week' => $weekNumber,
				'programs' => $programs,
				'subscribed' => $subscribed,
				'checkpoints' => $checkpoints,
				'finished' => $finishedSeasons
	 		]);
    }
    
    public function changePassword(Request $request)
    {
	    $this->validate($request, [
		    "password" => "required|min:6|confirmed"
	    ]);
	    
	    $user = \Auth::user();
	    
			$user->password = bcrypt($request->input('password'));
			
			$user->save();
			
			\Session::flash("alert-success", "The password has been updated!");
			
			return back();
    }
    
    public function tierSelect()
    {
	    if((FundedRegion::where('zip_code', \Auth::user()->site_zip_code)->exists() || FundedRegion::where('zip_code', \Auth::user()->shipping_zip_code)->exists()) && \Auth::user()->funded != 1){
		    	\Auth::user()->funded = 1;
		    	\Auth::user()->save();
	    	}
	    
	    if(\Auth::user()->shipping_address_1 && \Auth::user()->site_address_1 == null){
		    \Auth::user()->site_address_1 = \Auth::user()->shipping_address_1;
		    \Auth::user()->site_address_2 = \Auth::user()->shipping_address_2;
		    \Auth::user()->site_city = \Auth::user()->shipping_city;
		    \Auth::user()->site_state = \Auth::user()->shipping_state;
		    \Auth::user()->site_zip_code = \Auth::user()->shipping_zip_code;
		    \Auth::user()->save();
	    }
	    if(\Auth::user()->funded == 0){
		    if((FundedRegion::where('zip_code', \Auth::user()->site_zip_code)->exists() || FundedRegion::where('zip_code', \Auth::user()->shipping_zip_code)->exists())){
			    \Auth::user()->funded = 1;
			    \Auth::user()->save();
		    }
	    }
	    return view('auth.tier');
    }
    
    public function tierContinue(Request $request)
    {
	    if($request->input('promo-code') != ""){
		    $code = strtolower($request->input('promo-code'));
		    if(TrainingCode::where('code',$code)->where('expiration','>',\Carbon\Carbon::now())->count() > 0){
		    \Auth::user()->discount_code = $code;
		    if($request->input('program') == "mh"){
			    \Auth::user()->account_level = 1;
		    } else {
			    \Auth::user()->account_level = 2;
		    }
		    \Auth::user()->paid = 1;
		    \Auth::user()->save();
		    } else { 
			    \Session::flash('alert-danger','That training code does not exist or has expired.');
			    return back();
		    }
	    } else {
		    if($request->input('program') == "mh"){
			    \Auth::user()->account_level = 1;
		    } else {
			    \Auth::user()->account_level = 2;
		    }
		    \Auth::user()->save();
	    }
	    return redirect("/register/terms");
    }
    
    public function payment()
    {
	    return view('auth.payment');
    }
    
    public function paymentStep(Request $request)
    {
	    \Auth::user()->shipping_name = $request->input('shipping_name');
		\Auth::user()->shipping_address_1 = $request->input('shipping_address_1');
	    \Auth::user()->shipping_address_2 = $request->input('shipping_address_2');
	    \Auth::user()->shipping_city = $request->input('shipping_city');
	    \Auth::user()->shipping_state = $request->input('shipping_state');
	    \Auth::user()->shipping_zip_code = $request->input('shipping_zip_code');
	    
	    if(\Auth::user()->discount_code){
		    
		    \Auth::user()->paid = 1;
		    \Auth::user()->save();
		    
	    } else {
		    
		    \Auth::user()->billing_address_1 = $request->input('billing_address_1');
		    \Auth::user()->billing_address_2 = $request->input('billing_address_2');
		    \Auth::user()->billing_city = $request->input('billing_city');
		    \Auth::user()->billing_state = $request->input('billing_state');
		    \Auth::user()->billing_zip_code = $request->input('billing_zip_code');		    
		    \Auth::user()->paid = 1;
		    
		    \Auth::user()->save();
		    
		    if($request->input("payment-type") == "po"){
			    
			    \Auth::user()->paid = 3;
			    \Auth::user()->save();
			    
			    // Create Purchase Order
			    
			    $purchaseOrderNumber = 10001;
			    $lastPO = PurchaseOrder::orderBy('created_at','desc')->first();
			    if($lastPO){
				    $purchaseOrderNumber = $lastPO->purchase_order_number + 1;
			    }
			    
			    $po = PurchaseOrder::create([
				    "purchase_order_number" => $purchaseOrderNumber,
				    "user_id" => \Auth::user()->id,
				    "paid" => 0
			    ]);
			    
			    \Auth::user()->purchaseOrders()->save($po);
			    
			    Mail::to(\Auth::user()->email)->send(new SendPurchaseOrder($po));
			    
			    return redirect("/register/purchase-order");
			    
		    } else {
		    
			    $amount = 250;
			    
			    if(\Auth::user()->account_level == 2){
				    $amount = 1000;
			    }
			    
			    $this->validate($request, [
				    'card_number' => 'required',
				    'exp_month' => 'required|min:2',
				    'exp_year' => 'required|min:4',
				    'cvc' => 'required'
			    ]);
			    
			    $stripeConfig = \Config::get('services.stripe');	    
			    $stripe = new Stripe($stripeConfig['secret'],$stripeConfig['api']);
			    
			    try {
				    // Create customer
				    $customer = $stripe->customers()->create([
					    'email' => \Auth::user()->email
				    ]);
			    } catch (\Exception $e) {
				    \Session::flash('alert-danger', $e->getMessage());
				    return back()->withInput();
			    }
			    
			    try {
				    $token = $stripe->tokens()->create([
					    'card' => [
						    'number' => $request->input('card_number'),
						    'exp_month' => $request->input('exp_month'),
						    'exp_year' => $request->input('exp_year'),
						    'cvc' => $request->input('cvc')
					    ],
				    ]);
			    } catch (\Exception $e) {
				    \Session::flash('alert-danger', $e->getMessage());
				    return back()->withInput();
			    }
			    
			    try {
			    	$card = $stripe->cards()->create($customer['id'], $token['id']);
			    } catch (\Exception $e) {
				    \Session::flash('alert-danger', $e->getMessage());
				    return back()->withInput();
			    }
			    
			    try {
					$charge = $stripe->charges()->create([
					    'customer' => $customer['id'],
					    'currency' => 'USD',
					    'amount' => $amount
				    ]);			    
				    \Auth::user()->paid = 1;
				    \Auth::user()->save();
				    
				    if(\Auth::user()->account_level == 1){
					    
					    $quantity = 6;
						$cards = ceil($quantity/2);
						
						if($quantity == 0){
							$quantity++;
						}
						
						$stickers = $quantity * 2;
						
						if($cards == 0){
							$cards++;
						}
						
						$lastOrder = ShippingList::orderby('created_at','desc')->first();
						
						$orderNumber = \Carbon\Carbon::now()->format("Ymd") . "001";	
						if($lastOrder){
							if($orderNumber <= $lastOrder->order_number){
								$orderNumber = $lastOrder->order_number + 1;
							}
						}
						
						
						$shippingMethod = "Fedex Ground";
						
						if(!\Auth::user()->country || \Auth::user()->country == null || \Auth::user()->country == ""){
		  				\Auth::user()->country = "USA";
		  				\Auth::user()->save();
						}
						
						
						if(\Auth::user()->country != "USA"){
							$shippingMethod = "Fedex International";
						}
						
						$games = $quantity;
						$cards = $cards;
						
						$shippingName = \Auth::user()->name;
						if(\Auth::user()->shipping_name){
							$shippingName = \Auth::user()->shipping_name;
						}
						
						$shipStation = new \LaravelShipStation\ShipStation(getenv('SS_KEY'), getenv('SS_SECRET'));
					
						$address = new \LaravelShipStation\Models\Address();
						
						$address->name = $shippingName;
					    $address->street1 = \Auth::user()->shipping_address_1;
					    $address->street2 = \Auth::user()->shipping_address_2;
					    $address->city = \Auth::user()->shipping_city;
					    $address->state = \Auth::user()->shipping_state;
					    $address->postalCode = \Auth::user()->shipping_zip_code;
					    $address->country = "US";
					    $address->phone = \Auth::user()->phone;
						
						if(!\Auth::user()->isDemo()){
					    
				    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 48720,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
			 		    ]);
			 		    
			 		    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 48826,
						    "quantity" => $cards,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
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
			 		    
			 		    if(\Auth::user()->shipping_state == "UT"){
				 		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51011,
				  			    "quantity" => $games,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,			    
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
				   		    ]);
				   		    
				   		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51012,
				  			    "quantity" => $cards,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
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
				 		  
				 		  if(\Auth::user()->shipping_state == "WI"){
				 		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51021,
				  			    "quantity" => $games,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,			    
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
				   		    ]);
				   		    
				   		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51022,
				  			    "quantity" => $cards,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
				   		    ]);
				   		    
				   		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51023,
				  			    "quantity" => $games,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,			    
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
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
					    
					    if(\Auth::user()->shipping_state == "MI"){
			  		    
				  		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51001,
				  			    "quantity" => $games,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,			    
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
				   		    ]);
				   		    
				   		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51002,
				  			    "quantity" => $cards,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
				   		    ]);
				   		    
				   		    ShippingList::create([
				  			    "order_number" => $orderNumber,
				  			    "item" => 51003,
				  			    "quantity" => $games,
				  			    "recipient" => $shippingName,
				  			    "company" => \Auth::user()->school_program_name,
				  			    "address_1" => \Auth::user()->shipping_address_1,
				  			    "address_2" => \Auth::user()->shipping_address_2,
				  			    "city" => \Auth::user()->shipping_city,
				  			    "state" => \Auth::user()->shipping_state,
				  			    "post_code" => \Auth::user()->shipping_zip_code,
				  			    "country" => \Auth::user()->country,
				  			    "ship_method" => $shippingMethod,
				  			    "recipient_email" => \Auth::user()->email
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
							
							if(in_array(\Auth::user()->shipping_zip_code, $laZips)){
								ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51031,
								    "quantity" => $games,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
							    ]);
							    
							    ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51032,
								    "quantity" => $cards,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
							    ]);
							    
							    ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51033,
								    "quantity" => $games,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
							    ]);
							    
							    ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51034,
								    "quantity" => $games,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
							    ]);
							    
							    ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51035,
								    "quantity" => $cards,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
							    ]);
							    
							    ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51036,
								    "quantity" => $games,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
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
							
							if(in_array(\Auth::user()->site_zip_code, $philZips) || in_array(\Auth::user()->shipping_zip_code, $philZips)){
								ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51041,
								    "quantity" => $cards,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
							    ]);
							    
							    ShippingList::create([
								    "order_number" => $orderNumber,
								    "item" => 51042,
								    "quantity" => $games,
								    "recipient" => $shippingName,
								    "company" => \Auth::user()->school_program_name,
								    "address_1" => \Auth::user()->shipping_address_1,
								    "address_2" => \Auth::user()->shipping_address_2,
								    "city" => \Auth::user()->shipping_city,
								    "state" => \Auth::user()->shipping_state,			    
								    "post_code" => \Auth::user()->shipping_zip_code,
								    "country" => \Auth::user()->country,
								    "ship_method" => $shippingMethod,
								    "recipient_email" => \Auth::user()->email
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
					    
				    }
				    
				    return redirect("/home");
				} catch (\Exception $e) {
				    \Session::flash('alert-danger', $e->getMessage());
				    return back()->withInput();
			    }
		    
		    }
		    
	    }
	    
    }
    
    public function terms()
    {   
	    
	    return view('auth.terms');
    }
    
    public function termsAccept(Request $request)
    {
	    $this->validate($request, [
		    'agree' => 'required'
	    ]);
	    
	    if(\Auth::user()->paid == 1){
		    if(\Auth::user()->account_level == 1){			    
			    $quantity = 6;
				$cards = ceil($quantity/2);
				
				if($quantity == 0){
					$quantity++;
				}
				
				$stickers = $quantity * 2;
				
				if($cards == 0){
					$cards++;
				}
				
				$lastOrder = ShippingList::orderby('created_at','desc')->first();
				
				$orderNumber = \Carbon\Carbon::now()->format("Ymd") . "001";	
				if($lastOrder){
					if($orderNumber <= $lastOrder->order_number){
						$orderNumber = $lastOrder->order_number + 1;
					}
				}
				
				
				$shippingMethod = "Fedex Ground";
				
				if(!\Auth::user()->country || \Auth::user()->country == null || \Auth::user()->country == ""){
					\Auth::user()->country = "USA";
					\Auth::user()->save();
				}
				
				
				if(\Auth::user()->country != "USA"){
					$shippingMethod = "Fedex International";
				}
				
				$games = $quantity;
				$cards = $cards;
				
				$shippingName = \Auth::user()->name;
				if(\Auth::user()->shipping_name){
					$shippingName = \Auth::user()->shipping_name;
				}
				
				$shipStation = new \LaravelShipStation\ShipStation(getenv('SS_KEY'), getenv('SS_SECRET'));
			
				$address = new \LaravelShipStation\Models\Address();
				
				$address->name = $shippingName;
			    $address->street1 = \Auth::user()->shipping_address_1;
			    $address->street2 = \Auth::user()->shipping_address_2;
			    $address->city = \Auth::user()->shipping_city;
			    $address->state = \Auth::user()->shipping_state;
			    $address->postalCode = \Auth::user()->shipping_zip_code;
			    $address->country = "US";
			    $address->phone = \Auth::user()->phone;
				
				if(!\Auth::user()->isDemo()){
			    
		    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 48720,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,			    
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 48826,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
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
	 		    
	 		    if(\Auth::user()->shipping_state == "UT"){
		 		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51011,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51012,
		  			    "quantity" => $cards,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
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
		 		  
		 		  if(\Auth::user()->shipping_state == "WI"){
		 		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51021,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51022,
		  			    "quantity" => $cards,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51023,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
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
			    
			    if(\Auth::user()->shipping_state == "MI"){
	  		    
		  		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51001,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,			    
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51002,
		  			    "quantity" => $cards,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
		   		    ]);
		   		    
		   		    ShippingList::create([
		  			    "order_number" => $orderNumber,
		  			    "item" => 51003,
		  			    "quantity" => $games,
		  			    "recipient" => $shippingName,
		  			    "company" => \Auth::user()->school_program_name,
		  			    "address_1" => \Auth::user()->shipping_address_1,
		  			    "address_2" => \Auth::user()->shipping_address_2,
		  			    "city" => \Auth::user()->shipping_city,
		  			    "state" => \Auth::user()->shipping_state,
		  			    "post_code" => \Auth::user()->shipping_zip_code,
		  			    "country" => \Auth::user()->country,
		  			    "ship_method" => $shippingMethod,
		  			    "recipient_email" => \Auth::user()->email
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
					
					if(in_array(\Auth::user()->shipping_zip_code, $laZips)){
						ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51031,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51032,
						    "quantity" => $cards,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51033,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51034,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51035,
						    "quantity" => $cards,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51036,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
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
					
					if(in_array(\Auth::user()->site_zip_code, $philZips) || in_array(\Auth::user()->shipping_zip_code, $philZips)){
						ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51041,
						    "quantity" => $cards,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
					    ]);
					    
					    ShippingList::create([
						    "order_number" => $orderNumber,
						    "item" => 51042,
						    "quantity" => $games,
						    "recipient" => $shippingName,
						    "company" => \Auth::user()->school_program_name,
						    "address_1" => \Auth::user()->shipping_address_1,
						    "address_2" => \Auth::user()->shipping_address_2,
						    "city" => \Auth::user()->shipping_city,
						    "state" => \Auth::user()->shipping_state,			    
						    "post_code" => \Auth::user()->shipping_zip_code,
						    "country" => \Auth::user()->country,
						    "ship_method" => $shippingMethod,
						    "recipient_email" => \Auth::user()->email
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
			    
		    }
		    
		    
		    \Session::flash("alert-success","Welcome to the MyLFCA!");
		    return redirect("/home");
	    } else {
	    	return redirect("/register/payment");
	    }
    }
    
    public function confirmation()
    {
	    return view("auth.confirmation");
    }
    
    public function confirmationProcess(Request $request)
    {
	    \Auth::user()->shipping_name = $request->input('shipping_name');
	    \Auth::user()->shipping_address_1 = $request->input('shipping_address_1');
	    \Auth::user()->shipping_address_2 = $request->input('shipping_address_2');
	    \Auth::user()->shipping_city = $request->input('shipping_city');
	    \Auth::user()->shipping_state = $request->input('shipping_state');
	    \Auth::user()->shipping_zip_code = $request->input('shipping_zip_code');
	    \Auth::user()->paid = 1;
	    \Auth::user()->registered = Carbon::now();
	    \Auth::user()->save();
	    
	    $shippingName = \Auth::user()->name;
			if(\Auth::user()->shipping_name){
				$shippingName = \Auth::user()->shipping_name;
			} 
	    
	    // Bronze order
	    if(\Auth::user()->account_level == "bronze"){
		    $order = 1001;
				
				$lastOrder = ShippingList::orderby('created_at','desc')->first();
				
				if($lastOrder){
					$order = $lastOrder->order_number;
					if($order < 3854){
						$order = 3854;
					} else {
					$order++;
					}
				}
				
				$shippingMethod = "Fedex Ground";
				
				if(!\Auth::user()->country || \Auth::user()->country == null || \Auth::user()->country == ""){
  				\Auth::user()->country = "USA";
  				\Auth::user()->save();
				}
				
				
				if(\Auth::user()->country != "USA"){
					$shippingMethod = "Fedex International";
				}
				
				$games = 4;
				$cards = 2;
				
				if(!\Auth::user()->isDemo()){
		    
			    ShippingList::create([
				    "order_number" => $order,
				    "item" => 48720,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,			    
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    ShippingList::create([
				    "order_number" => $order,
				    "item" => 48826,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    if(\Auth::user()->shipping_state == "UT"){
		 		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51011,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51012,
	  			    "quantity" => $cards,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
		 		  }
		 		  
		 		  if(\Auth::user()->shipping_state == "WI"){
		 		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51021,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51022,
	  			    "quantity" => $cards,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51023,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
		 		  }
			    
			    if(\Auth::user()->shipping_state == "MI"){
	  		    
	  		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51001,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51002,
	  			    "quantity" => $cards,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51003,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	  		    
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
					
					if(in_array(\Auth::user()->shipping_zip_code, $laZips)){
						ShippingList::create([
					    "order_number" => $order,
					    "item" => 51031,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51032,
					    "quantity" => $cards,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51033,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51034,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51035,
					    "quantity" => $cards,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51036,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
					}
					
					$philZips = FundedRegion::where('team','phi')->get()->toArray();
					
					if(in_array(\Auth::user()->site_zip_code, $philZips) || in_array(\Auth::user()->shipping_zip_code, $philZips)){
						ShippingList::create([
					    "order_number" => $order,
					    "item" => 51041,
					    "quantity" => $cards,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51042,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
					}
	 		    
	 		  }
		 		  
	    }
	    
	    // Silver order
	    if(\Auth::user()->account_level == "silver"){
		    	$order = 1001;
				$lastOrder = ShippingList::orderby('created_at','desc')->first();
				
				if($lastOrder){
					$order = $lastOrder->order_number;
					if($order < 3854){
						$order = 3854;
					} else {
					$order++;
					}
				}
				
				$shippingMethod = "Fedex Ground";
				
				if(!\Auth::user()->country || \Auth::user()->country == null || \Auth::user()->country == ""){
  				\Auth::user()->country = "USA";
  				\Auth::user()->save();
				}
				
				
				if(\Auth::user()->country != "USA"){
					$shippingMethod = "Fedex International";
				}
				
				$games = 8;
				$cards = 4;
				
				if(!\Auth::user()->isDemo()){
		    
			    ShippingList::create([
				    "order_number" => $order,
				    "item" => 48720,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,			    
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    ShippingList::create([
				    "order_number" => $order,
				    "item" => 48826,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    if(\Auth::user()->shipping_state == "UT"){
		 		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51011,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51012,
	  			    "quantity" => $cards,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
		 		  }
		 		  
		 		  if(\Auth::user()->shipping_state == "WI"){
		 		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51021,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51022,
	  			    "quantity" => $cards,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51023,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
		 		  }
			    
			    if(\Auth::user()->shipping_state == "MI"){
	  		    
	  		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51001,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,			    
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51002,
	  			    "quantity" => $cards,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	   		    
	   		    ShippingList::create([
	  			    "order_number" => $order,
	  			    "item" => 51003,
	  			    "quantity" => $games,
	  			    "recipient" => $shippingName,
	  			    "company" => \Auth::user()->school_program_name,
	  			    "address_1" => \Auth::user()->shipping_address_1,
	  			    "address_2" => \Auth::user()->shipping_address_2,
	  			    "city" => \Auth::user()->shipping_city,
	  			    "state" => \Auth::user()->shipping_state,
	  			    "post_code" => \Auth::user()->shipping_zip_code,
	  			    "country" => \Auth::user()->country,
	  			    "ship_method" => $shippingMethod,
	  			    "recipient_email" => \Auth::user()->email
	   		    ]);
	  		    
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
					
					if(in_array(\Auth::user()->shipping_zip_code, $laZips)){
						ShippingList::create([
					    "order_number" => $order,
					    "item" => 51031,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51032,
					    "quantity" => $cards,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51033,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51034,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51035,
					    "quantity" => $cards,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51036,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
					}
					
					$philZips = FundedRegion::where('team','phi')->get()->toArray();
					
					if(in_array(\Auth::user()->site_zip_code, $philZips) || in_array(\Auth::user()->shipping_zip_code, $philZips)){
						ShippingList::create([
					    "order_number" => $order,
					    "item" => 51035,
					    "quantity" => $cards,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
				    
				    ShippingList::create([
					    "order_number" => $order,
					    "item" => 51036,
					    "quantity" => $games,
					    "recipient" => $shippingName,
					    "company" => \Auth::user()->school_program_name,
					    "address_1" => \Auth::user()->shipping_address_1,
					    "address_2" => \Auth::user()->shipping_address_2,
					    "city" => \Auth::user()->shipping_city,
					    "state" => \Auth::user()->shipping_state,			    
					    "post_code" => \Auth::user()->shipping_zip_code,
					    "country" => \Auth::user()->country,
					    "ship_method" => $shippingMethod,
					    "recipient_email" => \Auth::user()->email
				    ]);
					}
	 		    
	 		  }
		 		  
	    }
	    
	    return redirect("/home");
	    
    }
    
    public function requestGames()
    {
	    return view('request-games');
    }
    
    public function updateOrder(Request $request)
    {
	    $games = (int)$request->input("query");
	    $cost = $games * 20.00;
	    $shipping = 7.50;
	    if($games <= 4){
		    $shipping = 7.50 * $games;
	    } elseif($games <= 8) {
		    $shipping = 6.00 * $games;
	    }else {
		    $shipping = 5.50 * $games;
	    }
	    return view("game-list", [
		    "games" => $games,
		    "cost" => $cost,
		    "shipping" => $shipping
	    ]);
    }
    
    public function placeGamesOrder(Request $request)
    {
	    $games = (int)$request->input("games");
	    $cards = ceil($games/2);
	    $shipping = 7.50;
	    if($games <= 4){
		    $shipping = 7.50 * $games;
	    } elseif($games <= 8) {
		    $shipping = 6.00 * $games;
	    }else {
		    $shipping = 5.50 * $games;
	    }
	    $shipping += $games*20;
	    
    	$this->validate($request, [
		    'card_number' => 'required',
		    'exp_month' => 'required|min:2',
		    'exp_year' => 'required|min:4',
		    'cvc' => 'required'
	    ]);
	    
	    $stripeConfig = \Config::get('services.stripe');
	    
	    $stripe = new Stripe($stripeConfig['secret'],$stripeConfig['api']);
	    
	    try {
		    // Create customer
		    $customer = $stripe->customers()->create([
			    'email' => \Auth::user()->email
		    ]);
	    } catch (\Exception $e) {
		    \Session::flash('alert-danger', $e->getMessage());
		    return back()->withInput();
	    }
	    
	    try {
		    $token = $stripe->tokens()->create([
			    'card' => [
				    'number' => $request->input('card_number'),
				    'exp_month' => $request->input('exp_month'),
				    'exp_year' => $request->input('exp_year'),
				    'cvc' => $request->input('cvc')
			    ],
		    ]);
	    } catch (\Exception $e) {
		    \Session::flash('alert-danger', $e->getMessage());
		    return back()->withInput();
	    }
	    
	    try {
	    	$card = $stripe->cards()->create($customer['id'], $token['id']);
	    } catch (\Exception $e) {
		    \Session::flash('alert-danger', $e->getMessage());
		    return back()->withInput();
	    }
	    
	    try {
				  $charge = $stripe->charges()->create([
				    'customer' => $customer['id'],
				    'currency' => 'USD',
				    'amount' => $shipping
			    ]);			    
		  } catch (\Exception $e) {
		    \Session::flash('alert-danger', $e->getMessage());
		    return back()->withInput();
	    }
	    
	    if($charge) {
		    	$orderNumber = 1001;				
				$lastOrder = ShippingList::orderby('created_at','desc')->first();
				$orderNumber = \Carbon\Carbon::now()->format("Ymd") . "001";	
				if($lastOrder){
					if($orderNumber <= $lastOrder->order_number){
						$orderNumber = $lastOrder->order_number + 1;
					}
				}
				
				$shippingMethod = "Fedex Ground";
				
				if(!\Auth::user()->country || \Auth::user()->country == null || \Auth::user()->country == ""){
					\Auth::user()->country = "USA";
					\Auth::user()->save();
				}
					
				if(\Auth::user()->country != "USA"){
					$shippingMethod = "Fedex International";
				}
				
				$shippingName = \Auth::user()->name;
				if(\Auth::user()->shipping_name){
					$shippingName = \Auth::user()->shipping_name;
				} 
				
				if(!\Auth::user()->isDemo()){
					
				$shipStation = new \LaravelShipStation\ShipStation(getenv('SS_KEY'), getenv('SS_SECRET'));
				$order = new \LaravelShipStation\Models\Order();
				
				$address = new \LaravelShipStation\Models\Address();		
				$address->name = $request->input('recipient');
			    $address->street1 = $request->input('address_1');
			    $address->city = $request->input('city');
			    $address->state = $request->input('state');
			    $address->postalCode = $request->input('post_code');
			    $address->country = "US";
			    $address->phone = $request->input('phone');	
		    
			    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 48720,
				    "quantity" => $games,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,			    
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
	 		    ]);
	 		    
	 		    ShippingList::create([
				    "order_number" => $orderNumber,
				    "item" => 48826,
				    "quantity" => $cards,
				    "recipient" => $shippingName,
				    "company" => \Auth::user()->school_program_name,
				    "address_1" => \Auth::user()->shipping_address_1,
				    "address_2" => \Auth::user()->shipping_address_2,
				    "city" => \Auth::user()->shipping_city,
				    "state" => \Auth::user()->shipping_state,
				    "post_code" => \Auth::user()->shipping_zip_code,
				    "country" => \Auth::user()->country,
				    "ship_method" => $shippingMethod,
				    "recipient_email" => \Auth::user()->email
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
			    
			    $order->orderNumber = $orderNumber;
			    $order->orderDate = \Carbon\Carbon::now()->toDateString();
			    $order->orderStatus = 'awaiting_shipment';
			    $order->amountPaid = '0.00';
			    $order->taxAmount = '0.00';
			    $order->shippingAmount = '0.00';
			    $order->internalNotes = $request->input('notes');
			    $order->billTo = $address;
			    $order->shipTo = $address;
				
				$shipStation->orders->post($order, 'createorder');
	 		    
	 		  }
		    
		    \Session::flash('alert-success','Thank you for ordering additional games!');
		    return redirect('/home');
	    } else {
		    \Session::flash('alert-danger','An error occurred.');
		    return back()->withInput();
	    }
	        
    }
    
    public function purchaseOrder()
    {
	    $purchaseOrder = PurchaseOrder::where('user_id', \Auth::user()->id)->where('paid',0)->orderBy('created_at','desc')->first();
	    return view("auth.purchase-order", [
		    "po" => $purchaseOrder
	    ]);
    }
}
