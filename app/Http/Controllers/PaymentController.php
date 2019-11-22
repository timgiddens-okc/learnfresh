<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;

class PaymentController extends Controller
{
    public function show()
    {
	    if(\Auth::check() && \Auth::user()->paid == 0){
	    	return view("payment");
	    } else {
		    return redirect("/home");
	    }
    }
    
    public function makePayment(Request $request)
    {
	    if(\Auth::user()->type == 0){
		    $user = \Auth::user();
		    $user->paid = 1;
		    $user->save();
		    
		    \Session::flash('alert-success','Thank you for making your payment! We\'re excited to have you join LFCA!');
		    return redirect('/home');
		  } else {
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
			    if(\Auth::user()->discount_code == "LF50"){
				    $charge = $stripe->charges()->create([
					    'customer' => $customer['id'],
					    'currency' => 'USD',
					    'amount' => 50.00
				    ]);
			    } else {
					  $charge = $stripe->charges()->create([
					    'customer' => $customer['id'],
					    'currency' => 'USD',
					    'amount' => 100.00
				    ]);			    
			    }
			  } catch (\Exception $e) {
			    \Session::flash('alert-danger', $e->getMessage());
			    return back()->withInput();
		    }
		    
		    if($charge) {
			    $user = \Auth::user();
			    $user->paid = 1;
			    $user->save();
			    
			    \Session::flash('alert-success','Thank you for making your payment! We\'re excited to have you join LFCA!');
			    return redirect('/home');
		    } else {
			    \Session::flash('alert-danger','An error occurred.');
			    return back()->withInput();
		    }
	    }
    }
}
