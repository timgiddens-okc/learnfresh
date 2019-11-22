<?php

namespace App;

use Excel;
use Preassessment;
use Postassessment;
use Illuminate\Database\Eloquent\Model;

class SavedAssessment extends Model
{
    protected $fillable = ['file','type'];
}
