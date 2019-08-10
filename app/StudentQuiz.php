<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    //
    protected $fillable = ['quiz_id','student_id','mark','attempt_allowed','attempt'];
}
