<?php
	
namespace App\Http\Controllers;

use App\Championship;
use App\Application;
use App\KitOrder;
use App\Mail\KitReceipt;
use Excel;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class PageController extends Controller
{
  
  public function kit()
  {
	  return view("kit");
  }
  
  public function purchaseKit(Request $request)
  {
	$lastOrder = KitOrder::orderby('created_at','desc')->first();
	$order = "HCS001";	
	if($lastOrder){
		$order = $lastOrder->order_number;
		$order++;
	}
	
	$small = (int)$request->input('small');
	$medium = (int)$request->input('medium');
	$large = (int)$request->input('large');
	$xl = (int)$request->input('x-large');
	
	$totalShirts = $small + $medium + $large + $xl;
	$grandTotal = number_format((14.99*$totalShirts)+199.99,2);
	
	$large += 8;
	
	$orderItems = array();
	
	$stripeConfig = \Config::get('services.stripe');
    
    $stripe = new Stripe($stripeConfig['secret'],$stripeConfig['api']);
    
    if(\Auth::user()->isAdmin()){
	    
	    // Gold Medals
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63001,
		    "quantity" => 2,
		    "recipient" => $request->input("recipient"),
		    "company" => $request->input("company"),
		    "address_1" => $request->input("shipping_address_1"),
		    "address_2" => $request->input("shipping_address_2"),
		    "city" => $request->input("shipping_city"),
		    "state" => $request->input("shipping_state"),
		    "post_code" => $request->input("shipping_zip_code"),
		    "country" => "USA",
		    "phone" => $request->input("phone"),
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => $request->input("email")
	    ]);
	    
	    // Silver Medals
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63002,
		    "quantity" => 2,
		    "recipient" => $request->input("recipient"),
		    "company" => $request->input("company"),
		    "address_1" => $request->input("shipping_address_1"),
		    "address_2" => $request->input("shipping_address_2"),
		    "city" => $request->input("shipping_city"),
		    "state" => $request->input("shipping_state"),
		    "post_code" => $request->input("shipping_zip_code"),
		    "country" => "USA",
		    "phone" => $request->input("phone"),
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => $request->input("email")
	    ]);
	    
	    // Bronze Medals
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63003,
		    "quantity" => 2,
		    "recipient" => $request->input("recipient"),
		    "company" => $request->input("company"),
		    "address_1" => $request->input("shipping_address_1"),
		    "address_2" => $request->input("shipping_address_2"),
		    "city" => $request->input("shipping_city"),
		    "state" => $request->input("shipping_state"),
		    "post_code" => $request->input("shipping_zip_code"),
		    "country" => "USA",
		    "phone" => $request->input("phone"),
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => $request->input("email")
	    ]);
	    
	    // Poster
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63101,
		    "quantity" => 1,
		    "recipient" => $request->input("recipient"),
		    "company" => $request->input("company"),
		    "address_1" => $request->input("shipping_address_1"),
		    "address_2" => $request->input("shipping_address_2"),
		    "city" => $request->input("shipping_city"),
		    "state" => $request->input("shipping_state"),
		    "post_code" => $request->input("shipping_zip_code"),
		    "country" => "USA",
		    "phone" => $request->input("phone"),
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => $request->input("email")
	    ]);
	    
	    if($small > 0){
		    // Small Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-S",
			    "quantity" => $small,
			    "recipient" => $request->input("recipient"),
			    "company" => $request->input("company"),
			    "address_1" => $request->input("shipping_address_1"),
			    "address_2" => $request->input("shipping_address_2"),
			    "city" => $request->input("shipping_city"),
			    "state" => $request->input("shipping_state"),
			    "post_code" => $request->input("shipping_zip_code"),
			    "country" => "USA",
			    "phone" => $request->input("phone"),
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => $request->input("email")
		    ]);
		    $orderItems["Small T-Shirts"] = $small;
	    }
	    
	    if($medium > 0){
		    // Medium Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-M",
			    "quantity" => $medium,
			    "recipient" => $request->input("recipient"),
			    "company" => $request->input("company"),
			    "address_1" => $request->input("shipping_address_1"),
			    "address_2" => $request->input("shipping_address_2"),
			    "city" => $request->input("shipping_city"),
			    "state" => $request->input("shipping_state"),
			    "post_code" => $request->input("shipping_zip_code"),
			    "country" => "USA",
			    "phone" => $request->input("phone"),
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => $request->input("email")
		    ]);
		    $orderItems["Medium T-Shirts"] = $medium;
	    }
	    
	    if($large > 0){
		    // Large Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-L",
			    "quantity" => $large,
			    "recipient" => $request->input("recipient"),
			    "company" => $request->input("company"),
			    "address_1" => $request->input("shipping_address_1"),
			    "address_2" => $request->input("shipping_address_2"),
			    "city" => $request->input("shipping_city"),
			    "state" => $request->input("shipping_state"),
			    "post_code" => $request->input("shipping_zip_code"),
			    "country" => "USA",
			    "phone" => $request->input("phone"),
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => $request->input("email")
		    ]);
		    if($large != 8){
		    	$orderItems["Large T-Shirts"] = $large;
		    }
	    }
	    
	    if($xl > 0){
		    // XL Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-XL",
			    "quantity" => $xl,
			    "recipient" => $request->input("recipient"),
			    "company" => $request->input("company"),
			    "address_1" => $request->input("shipping_address_1"),
			    "address_2" => $request->input("shipping_address_2"),
			    "city" => $request->input("shipping_city"),
			    "state" => $request->input("shipping_state"),
			    "post_code" => $request->input("shipping_zip_code"),
			    "country" => "USA",
			    "phone" => $request->input("phone"),
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => $request->input("email")
		    ]);
		    $orderItems["XL T-Shirts"] = $xl;
	    }
	    
	} else {
    
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
		    'amount' => $grandTotal
	    ]);			    
	  } catch (\Exception $e) {
	    \Session::flash('alert-danger', $e->getMessage());
	    return back()->withInput();
    }
    
    if($charge) {
	    
		// Gold Medals
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63001,
		    "quantity" => 2,
		    "recipient" => \Auth::user()->name,
		    "company" => \Auth::user()->school_program_name,
		    "address_1" => \Auth::user()->shipping_address_1,
		    "address_2" => \Auth::user()->shipping_address_2,
		    "city" => \Auth::user()->shipping_city,
		    "state" => \Auth::user()->shipping_state,
		    "post_code" => \Auth::user()->shipping_zip_code,
		    "country" => \Auth::user()->country,
		    "phone" => \Auth::user()->phone,
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => \Auth::user()->email
	    ]);
	    
	    // Silver Medals
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63002,
		    "quantity" => 2,
		    "recipient" => \Auth::user()->name,
		    "company" => \Auth::user()->school_program_name,
		    "address_1" => \Auth::user()->shipping_address_1,
		    "address_2" => \Auth::user()->shipping_address_2,
		    "city" => \Auth::user()->shipping_city,
		    "state" => \Auth::user()->shipping_state,
		    "post_code" => \Auth::user()->shipping_zip_code,
		    "country" => \Auth::user()->country,
		    "phone" => \Auth::user()->phone,
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => \Auth::user()->email
	    ]);
	    
	    // Bronze Medals
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63003,
		    "quantity" => 2,
		    "recipient" => \Auth::user()->name,
		    "company" => \Auth::user()->school_program_name,
		    "address_1" => \Auth::user()->shipping_address_1,
		    "address_2" => \Auth::user()->shipping_address_2,
		    "city" => \Auth::user()->shipping_city,
		    "state" => \Auth::user()->shipping_state,
		    "post_code" => \Auth::user()->shipping_zip_code,
		    "country" => \Auth::user()->country,
		    "phone" => \Auth::user()->phone,
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => \Auth::user()->email
	    ]);
	    
	    // Poster
		KitOrder::create([
		    "order_number" => $order,
		    "item" => 63101,
		    "quantity" => 1,
		    "recipient" => \Auth::user()->name,
		    "company" => \Auth::user()->school_program_name,
		    "address_1" => \Auth::user()->shipping_address_1,
		    "address_2" => \Auth::user()->shipping_address_2,
		    "city" => \Auth::user()->shipping_city,
		    "state" => \Auth::user()->shipping_state,
		    "post_code" => \Auth::user()->shipping_zip_code,
		    "country" => \Auth::user()->country,
		    "phone" => \Auth::user()->phone,
		    "ship_method" => "FedEx Ground",
		    "recipient_email" => \Auth::user()->email
	    ]);
	    
	    if($small > 0){
		    // Small Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-S",
			    "quantity" => $small,
			    "recipient" => \Auth::user()->name,
			    "company" => \Auth::user()->school_program_name,
			    "address_1" => \Auth::user()->shipping_address_1,
			    "address_2" => \Auth::user()->shipping_address_2,
			    "city" => \Auth::user()->shipping_city,
			    "state" => \Auth::user()->shipping_state,
			    "post_code" => \Auth::user()->shipping_zip_code,
			    "country" => \Auth::user()->country,
			    "phone" => \Auth::user()->phone,
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => \Auth::user()->email
		    ]);
		    $orderItems["Small T-Shirts"] = $small;
	    }
	    
	    if($medium > 0){
		    // Medium Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-M",
			    "quantity" => $medium,
			    "recipient" => \Auth::user()->name,
			    "company" => \Auth::user()->school_program_name,
			    "address_1" => \Auth::user()->shipping_address_1,
			    "address_2" => \Auth::user()->shipping_address_2,
			    "city" => \Auth::user()->shipping_city,
			    "state" => \Auth::user()->shipping_state,
			    "post_code" => \Auth::user()->shipping_zip_code,
			    "country" => \Auth::user()->country,
			    "phone" => \Auth::user()->phone,
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => \Auth::user()->email
		    ]);
		    $orderItems["Medium T-Shirts"] = $medium;
	    }
	    
	    if($large > 0){
		    // Large Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-L",
			    "quantity" => $large,
			    "recipient" => \Auth::user()->name,
			    "company" => \Auth::user()->school_program_name,
			    "address_1" => \Auth::user()->shipping_address_1,
			    "address_2" => \Auth::user()->shipping_address_2,
			    "city" => \Auth::user()->shipping_city,
			    "state" => \Auth::user()->shipping_state,
			    "post_code" => \Auth::user()->shipping_zip_code,
			    "country" => \Auth::user()->country,
			    "phone" => \Auth::user()->phone,
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => \Auth::user()->email
		    ]);
		    if($large != 8){
		    	$orderItems["Large T-Shirts"] = $large;
		    }
	    }
	    
	    if($xl > 0){
		    // XL Shirts
			KitOrder::create([
			    "order_number" => $order,
			    "item" => "64201-XL",
			    "quantity" => $xl,
			    "recipient" => \Auth::user()->name,
			    "company" => \Auth::user()->school_program_name,
			    "address_1" => \Auth::user()->shipping_address_1,
			    "address_2" => \Auth::user()->shipping_address_2,
			    "city" => \Auth::user()->shipping_city,
			    "state" => \Auth::user()->shipping_state,
			    "post_code" => \Auth::user()->shipping_zip_code,
			    "country" => \Auth::user()->country,
			    "phone" => \Auth::user()->phone,
			    "ship_method" => "FedEx Ground",
			    "recipient_email" => \Auth::user()->email
		    ]);
		    $orderItems["XL T-Shirts"] = $xl;
	    }
	    
	    \Mail::to(\Auth::user()->email)->send(new KitReceipt($orderItems,$grandTotal));
	    
	    \Session::flash('alert-success', 'Your order has been placed!');
	    
	} else {
		\Session::flash('alert-danger', 'An error happened!');
	}
	}
		return back();
  }
  
  public function championship(){
	  $championship = Championship::first();
	  return view("championship", [
		  "championship" => $championship
	  ]);
  }
  
  public function application()
  {
	  return view("national-championship.application");
  }
  
  public function submitApplication(Request $request)
  {
	  $application = Application::create($request->all());

	  $application->educator_id = \Auth::user()->id;
	  $application->save();

	  \Session::flash('alert-success','Thanks for applying for the National Championship!');
	  return redirect('/home');
  }
  
}
