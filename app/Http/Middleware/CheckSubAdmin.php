<?php

namespace App\Http\Middleware;

use Closure;

class CheckSubAdmin
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
      if (\Auth::check() && \Auth::user()->isSubAdmin())
	    {
		    return $next($request);
	    }
	   
	    \Session::flash('alert-warning','You do not have sub admin privileges.');
	    return redirect('/home');
    }
}
