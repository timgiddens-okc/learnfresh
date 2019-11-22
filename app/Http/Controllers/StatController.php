<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatController extends Controller
{
    public function eventStats()
    {
	    return view('admin.stats.event-stats');
    }
    
    public function preTestsCount()
    {
	    return view('admin.stats.pre-test-count');
    }
    
    public function postTestsCount()
    {
	    return view('admin.stats.post-test-count');
    }
    
    public function totalUsers()
    {
	    return view('admin.stats.total-users');
    }
    
    public function totalPaidUsers()
    {
	    return view('admin.stats.total-paid-users');
    }
    
    public function totalNewUsers()
    {
	    return view('admin.stats.total-new-users');
    }

		public function totalReturningUsers()
    {
	    return view('admin.stats.total-returning-users');
    }
    
    public function grossRevenue()
    {
	    return view('admin.stats.gross-revenue');
    }
    
    public function estimatedStudents()
    {
	    return view('admin.stats.estimated-students');
    }
    
    public function registeredSubmittedPretest()
    {
	    return view('admin.stats.registered-submitted-pretest');
    }
    
    public function gamesShipped()
    {
	    return view('admin.stats.games-shipped');
    }
    
    public function pendingShipments()
    {
	    return view('admin.stats.pending-shipments');
    }
    
    public function lastComment()
    {
	    return view('admin.stats.last-comment');
    }
}
