<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
		protected $fillable = ['week_number', 'title', 'description', 'featured_resource'];
		
		public function resource()
		{
			return $this->hasOne(Resource::class);
		}
		
		public function program()
		{
			return $this->belongsTo(Program::class);
		}
		
    public function items()
    {
    	return $this->hasMany(ActionItem::class);
    }
    
    public function addResource(Resource $resource)
    {    	
    	$this->resource()->save($resource);
    }
    
    public function addActionItem(ActionItem $actionItem)
    {
    	$actionItem->week_id = $this->id;
    	
    	$this->items()->save($actionItem);
    }
}
