<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Vote;

class Application extends Model
{
    protected $guarded = ['id'];
    
    public function votes()
    {
	    return $this->hasMany(Vote::class);
    }
}
