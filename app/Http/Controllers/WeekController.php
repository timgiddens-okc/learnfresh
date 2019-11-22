<?php

namespace App\Http\Controllers;

use DB;
use App\Week;
use App\ActionItem;
use App\Resource;
use App\Program;
use Illuminate\Http\Request;

class WeekController extends Controller
{
	
		public function __construct()
		{
				$this->middleware('admin');
		}
	
    public function index()
    {
	    	$resources = Resource::all();
    		return view("admin.weeks.new", [
	    		'resources' => $resources
    		]);
    }
    
    public function show(Week $week)
    {
	    
	    $resource = null;
	    
	    if($week->featured_resource){
				$resource = Resource::find($week->featured_resource);
			}
	    
	    return view("admin.weeks.show", [
		    'week' => $week,
		    'resource' => $resource
	    ]);
    }
    
    public function edit(Week $week)
    {
	    		$resources = Resource::all();
    			return view("admin.weeks.edit", [
	    			'week' => $week,
	    			'resources' => $resources
    			]);
    }
    
    public function delete(Week $week)
    {
	    ActionItem::where('week_id',$week->id)->delete();
	    $week->delete();
	    
	    \Session::flash('alert-success','The week has been deleted!');
	    return redirect('/home');
    }
    
    public function update(Request $request, Week $week)
    {
	    $week->update($request->all());
	    
    	return redirect('/week/' . $week->id);
    }
    
    public function showEditItem(Week $week, ActionItem $actionItem)
    {
	    return view('admin.weeks.items.edit', [
		    'item' => $actionItem
	    ]);
    }
    
    public function itemDestroy(Week $week, ActionItem $actionItem)
    {
	    $actionItem->delete();
	    
	    return redirect('/week/' . $week->id);
    }
    
    public function editItem(Week $week, ActionItem $actionItem, Request $request)
    {
	    $actionItem->update($request->all());
	    
	    return redirect('/week/' . $week->id);
    }
    
    public function store(Request $request, Program $program)
    {
	    $this->validate($request, [
		    'week_number' => 'numeric'
	    ]);
	    
	    $resource = null;
	    
	    if($request->input('featured_resource') != ""){
	    	$resource = Resource::find($request->input('featured_resource'));
	    }
	    
	    $week = new Week($request->all());
	    
	    if($resource){
	    	$week->resource()->save($resource);
	    }
	    
	    $program->addWeek($week);
	    
	    $week->save();
	    
	    return redirect('/program/' . $program->id);
    }
}
