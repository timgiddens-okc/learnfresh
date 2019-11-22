<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeeksNotification extends Model
{
    protected $fillable = ['user_id','week_id'];
}
