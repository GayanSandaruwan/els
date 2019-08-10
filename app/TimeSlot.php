<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    //
    protected $fillable = ['date','start_time','end_time','no_of_slots','current_slots','teacher','status'];


}
