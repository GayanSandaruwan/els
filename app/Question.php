<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['quiz_id','question', 'A', 'B','C','D','anzwer'];
}
