<?php

namespace App\Http\Controllers;

use App\Program;
use App\Resource;
use App\Week;
use App\ActionItem;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function new() {
	    return view('programs.new');
    }
    
    public function create(Request $request) {
	    $program = Program::create($request->all());
	    
	    if($request->file('logo')){	    
    		$file = $request->file('logo');
    		$fileName = time() . '.' . $file->getClientOriginalExtension();
				$file->move(base_path() . '/public/programs/', $fileName);
				$uploadedFile = "/programs/" . $fileName;
				$program->logo = $uploadedFile;
    	}
    	
    	
    	
    	$program->save();
	    
	    return redirect('/home');
    }
    
    public function edit(Program $program) {
	    return view('programs.edit', [
		   	"program" => $program
	   	]);
    }
    
    public function delete(Program $program) {
	    $weeks = Week::where("program_id",$program->id)->get();
	    foreach($weeks as $week){
		    ActionItem::where("week_id",$week->id)->delete();
		    $week->delete();
	    }
	    Resource::where("program_id",$program->id)->delete();
	    $program->delete();
	    \Session::flash('alert-success','The program has been deleted!');
	    return redirect('/home');
    }
    
    public function update(Request $request, Program $program) {
	    $program->update($request->all());
	    
	    if($request->file('logo')){	    
    		$file = $request->file('logo');
    		$fileName = time() . '.' . $file->getClientOriginalExtension();
				$file->move(base_path() . '/public/programs/', $fileName);
				$uploadedFile = "/programs/" . $fileName;
				$program->logo = $uploadedFile;
    	}
    	
    	$program->save();
	    
	    \Session::flash('alert-success','The program has been updated!');
	    
	    return redirect("/program/" . $program->id);
    }
    
    public function show(Program $program) {
	    $program->load('weeks');
	    
	    $resources = Resource::all();

	   	return view('programs.show', [
		   	"program" => $program,
		   	"resources" => $resources
	   	]);
    }
}
