<?php

namespace App\Http\Controllers;

use App\Week;
use App\ActionItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
		{
				$this->middleware('admin');
		}
		
		public function store(Request $request, Week $week)
		{
			
			$this->validate($request, [
				'text' => 'required',
			]);
			
			$item = new ActionItem($request->all());
			
			$week->addActionItem($item);
			
			return back();
		}
}
