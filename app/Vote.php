<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Application;

class Vote extends Model
{
    protected $guarded = ['id'];
    
    public function application()
    {
	    return $this->belongsTo(Application::class);
    }
}
