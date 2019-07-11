<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //

    protected $fillable = [
        'nic', 'address', 'edu_qual','prof_qual','specialization','user_id','contact',
    ];
}
