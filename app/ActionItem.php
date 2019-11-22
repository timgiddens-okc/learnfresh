<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionItem extends Model
{
		protected $fillable = ['text', 'page_link', 'week_id'];
	
    public function week()
    {
    	return $this->belongsTo('App\Week');
    }
}
