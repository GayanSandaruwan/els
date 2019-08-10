<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slot_Requests extends Model
{
    //
    protected $fillable = ['status','user_id','reason'];
}
