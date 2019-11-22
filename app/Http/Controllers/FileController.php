<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function download($file){
	    return response()->download(storage_path("exports/" . $file));
    }
}
