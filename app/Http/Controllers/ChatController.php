<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function test()
    {
        error_log("The guy just came here!");
//        event(new Message("Bijja"));
//        return "Event has been sent!";
        event(new MyEvent('hello world'));
        return "Event has been sent!";

    }
    public function sendChat(Request $request) {
        $data=$request->all();
        //saving chat
        $chat=Chat::create([
            'conv_id'=>$data['conver_id'],
            'user_name'=>Auth::user()->name,
            'user_id'=>Auth::user()->id,
            'text'=>$data['message']
        ]);
        event(new MyEvent( Auth::user()->name,$data['message'],$chat->created_at,'my-channel'));
        return "Event has been sent!";
    }
}
