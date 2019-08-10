<?php
//namespace App\Events;
namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $channel;
    public $time;

    public function __construct($sender,$message,$time,$channel)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->channel = $channel;
        $time->time=$time;
    }

    public function broadcastOn()
    {
        return [$this->channel];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}