<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompletedWeek extends Model
{
    protected $fillable = ['user_id','week_number','notified'];
}
