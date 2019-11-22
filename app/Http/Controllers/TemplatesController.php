<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Template;

class TemplatesController extends Controller
{
    public function index()
    {
	    $templates = Template::all();
	    
	    return view("templates.index", [
		    "templates" => $templates
	    ]);
    }
    
    public function createNew()
    {
	    return view("templates.new");
    }
    
    public function submitTemplate(Request $request)
    {
	    $this->validate($request, [
		   "name" => "unique:templates|required",
		   "template" => "required" 
	    ]);
	    
	    $template = Template::create($request->all());
	    $template->created_by = \Auth::user()->id;
	    $template->last_modified_by = \Auth::user()->id;
	    $template->save();
	    
	    \Session::flash("success", "The template has been created!");
	    return redirect("/contact/templates");
    }
    
    public function show(Template $template)
    {
	    return view("templates.show", [
		    "template" => $template
	    ]);
    }
    
    public function edit(Template $template)
    {
	    return view("templates.edit", [
		    "template" => $template
	    ]);
    }
    
    public function update(Request $request, Template $template)
    {
	    if($request->input('name') !== $template->name){
		    $this->validate($request, [
			   "name" => "unique:templates|required",
			   "template" => "required" 
		    ]);
	    }
	    
	    $template->update($request->all());
	    $template->last_modified_by = \Auth::user()->id;
	    $template->save();
	    
	    \Session::flash("success", "The template has been updated!");
	    return redirect("/contact/templates");
    }
    
    public function delete(Template $template)
    {
	    $template->delete();
	    
	    \Session::flash("success", "The template has been deleted!");
	    return redirect("/contact/templates");
    }
    
    public function sendEmail()
    {
	    $templates = Template::all();
	    return view("templates.send-email", [
		    "templates" => $templates
	    ]);
    }
    
    public function eventType(Request $request)
    {
	    $events = \App\Event::where('type', $request->input('type'))->get();
	    
	    return view("templates.event-type", [
		    "events" => $events
	    ]);
    }
    
    public function finalizeEmail(Request $request)
    {
	    
    }
}
