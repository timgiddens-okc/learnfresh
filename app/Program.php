<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['title','description','logo'];
    
    public function weeks() {
	    return $this->hasMany(Week::class);
    }
    
    public function resources() {
	    return $this->hasMany(Resource::class);
    }
    
    public function addResource(Resource $resource)
    {
    		$resource->program_id = $this->id;
    		
    		$this->resources()->save($resource);
    }
    
    public function addWeek(Week $week)
    {
    		$week->program_id = $this->id;
    		
    		$this->weeks()->save($week);
    }
}
