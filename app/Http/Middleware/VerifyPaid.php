<?php

namespace App\Http\Middleware;

use Closure;

class VerifyPaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
	    if(\Auth::user()->admin == 0){
		    if(\Auth::user()->account_level == null){
			    return redirect("/register/tier");
		    }
		    
		    if(\Auth::user()->shipping_address_1 == null){
			    return redirect("/register/payment");
		    }
		    
		    if(\Auth::user()->paid == 0){
			    return redirect("/register/terms");
		    }
		    
		    if(\Auth::user()->paid == 3){
			    return redirect("/register/purchase-order");
		    }
	    }
      return $next($request);
    }
}
