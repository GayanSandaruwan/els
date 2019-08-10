<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $fillable = ['grade', 'address', 'dob','user_id','contact'];
}
