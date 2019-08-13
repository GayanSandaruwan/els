<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SlotAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $date,$start_time, $end_time,$duration;
    public function __construct($date,$start_time,$end_time,$duration)
    {
        //
        $this->date = $date;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
        $this->duration = $duration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@elearning.lk')->subject('New Live Session')->markdown('email.notification.slotalert',['date'=> $this->date,'start_time'=>$this->start_time,'end_time'=>$this->end_time,'duration'=>$this->duration ]);
    }
}
