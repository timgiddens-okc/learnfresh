<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
		protected $fillable = ['name', 'gender', 'ethnicity', 'pre_assessment', 'post_assessment','grade'];
	
    public function teacher()
    {
    		return $this->belongsTo(User::class);
    }
}
