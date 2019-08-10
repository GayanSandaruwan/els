<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    //
    protected $fillable = ['student_id','parent_id','relationship',];

}
