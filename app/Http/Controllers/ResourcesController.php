<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Resource;
use App\Program;
use App\Week;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ResourcesController extends Controller
{
		public function sort()
		{
			$resources = Resource::orderBy('index')->get();
			return view('admin.resources.sort', [
				'resources' => $resources
			]);
		}
		
		public function saveOrder(Request $request)
		{
			$count = 1;
			foreach($request->input('resources') as $t){
				$resource = Resource::find($t);
				$resource->index = $count;
				$resource->save();
				$count++;
			}
			
			\Session::flash('alert-success','The resource order has been saved.');
			return redirect("/admin/resources");
		}
	
		public function all()
		{
			$programIds = explode(",", \Auth::user()->programs);
			
			$resources = Resource::orderBy('index')->get();
			
			foreach($resources as $key => $resource) {
				if(!in_array($resource->program_id, $programIds)){
					unset($resources[$key]);
				} else {
					$resource->load('program');
				}
			}
			
			$eventMedia = Resource::where("program_id",0)->orderBy('index')->get();
			
			return view('resources.index', [
				'resources' => $resources,
				'eventMedia' => $eventMedia
			]);
		}
	
    public function index()
    {
    			$resources = Resource::all();
    			$programs = Program::all();
    			return view('admin.resources.index', [
	    			'resources' => $resources,
	    			'programs' => $programs
    			]);
    }
    
    public function edit(Resource $resource)
    {
	    		$programs = Program::all();
    			return view('admin.resources.edit', [
	    			'resource' => $resource,
	    			'programs' => $programs
    			]);
    }
    
    public function delete(Resource $resource)
    {
	    $resource->delete();
	    \Session::flash('alert-success','The resource has been deleted!');
	    return redirect('/home');
    }
    
    public function download(Resource $resource)
    {
	    		$filepath = "/resources/1495742885.pdf";
    			return (new Response($filepath, 200))->header('Content-Type','application/pdf');
    }
    
    public function update(Request $request, Resource $resource)
    {
	    		$resource->update($request->all());
	    		
	    		$uploadedFile = null;
	    		
	    		if($request->file('file')){	    
		    		$file = $request->file('file');
		    		$fileName = time() . '.' . $file->getClientOriginalExtension();
						$file->move(base_path() . '/public/resources/', $fileName);
						$uploadedFile = "/resources/" . $fileName;
		    	}
		
		    	$resource->file_location = $uploadedFile;
		    	$resource->save();
	    
    			return back();
    }
    
    public function show(Resource $resource)
    {
    			return view('admin.resources.show', [
	    			'resource' => $resource
    			]);
    }
    
    public function store(Request $request)
    {
	    $this->validate($request, [
		    "title" => "required"
	    ]);
	    
	    $uploadedFile = null;
	    
	    $latestResource = Resource::orderBy('created_at','desc')->first();
	    $count = (int)$latestResource->index;
	    
	    if($count == null) {
		    $count = 1;
	    } else {
		    $count++;
	    }
	    
	    if($request->file('file')){	    
    		$file = $request->file('file');
    		$fileName = time() . '.' . $file->getClientOriginalExtension();
				$file->move(base_path() . '/public/resources/', $fileName);
				$uploadedFile = "/resources/" . $fileName;
    	}

    	$resource = Resource::create([
	    	'title' => $request->input('title'),
	    	'description' => $request->input('description'),
	    	'video_embed' => $request->input('video_embed'),
	    	'file_location' => $uploadedFile,
	    	'index' => $count
    	]);
    	
    	if($request->input('program') != "0"){
    		$program = Program::find($request->input('program'));
    	
    		$program->addResource($resource);
    	} else {
	    	$resource->program_id = 0;
	    	$resource->save();
    	}
    	
    	return back();
    }
    
    public function documents($area)
    {
	    $type = 0;
	    switch($area){
		    case "nba-math-hoops":
		    	$type = 1;
		    	break;
		    case "athletics-math-hits":
		    	$type = 3;
		    	break;
		    case "first-and-ten":
		    	$type = 2;
		    	break;
	    }
	    $docs = Resource::where("file_location","!=","")->where("program_id",$type)->orderBy("index")->get();
	    
	    return view("resources.documents", [
		    "docs" => $docs
	    ]);
    }
    
    public function tips($area)
    {
	    $type = 0;
	    switch($area){
		    case "nba-math-hoops":
		    	$type = 1;
		    	break;
		    case "athletics-math-hits":
		    	$type = 3;
		    	break;
		    case "first-and-ten":
		    	$type = 2;
		    	break;
	    }
	    
	    $weeks = Week::where("program_id", $type)->orderBy("week_number")->get();
	    return view("resources.tips", [
		    "weeks" => $weeks
	    ]);
    }
    
    public function videos($area)
    {
	    $type = 0;
	    switch($area){
		    case "nba-math-hoops":
		    	$type = 1;
		    	break;
		    case "athletics-math-hits":
		    	$type = 3;
		    	break;
		    case "first-and-ten":
		    	$type = 2;
		    	break;
	    }
	    $videos = Resource::where("video_embed","!=","")->where("program_id",$type)->orderBy("index")->get();
	    
	    return view("resources.videos", [
		    "videos" => $videos
	    ]);
    }
}
