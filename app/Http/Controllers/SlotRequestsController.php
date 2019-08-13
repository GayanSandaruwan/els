<?php

namespace App\Http\Controllers;

use App\Slot_Requests;
use App\Slot_Student;
use App\TimeSlot;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SlotRequestsController extends Controller
{

    protected function viewmyslots(Request $request){


        $data=$request->all();
        $user_id=Auth::user()->id;
        error_log("kkkkkkkkkkkkkkkkkk");
        $timeslots = TimeSlot::where('status', '=', 'active')->where('teacher','=',$user_id)->get();
        //check whether they are active
        $finalTimeSlots=[];
        date_default_timezone_set("Asia/Colombo");
        foreach ($timeslots as $slot) {
//            error_log(date("Y-m-d H:i:s", strtotime("now")));
//            error_log("Date is ".  strtotime("now") ." ".strtotime("2019-08-11 22:24:00"). " " .strtotime($slot->date . " " . $slot->start_time));

            if (new \DateTime() > new \DateTime($slot->date . $slot->end_time)) {
                error_log("Found a past time");
                $slot->status = "deactive";
                $slot->save();
            } else {
                error_log(strtotime("now")." ".strtotime($slot->date . " " . $slot->start_time));
                if ( strtotime("now") > strtotime($slot->date . " " . $slot->start_time)) {

                    if (new \DateTime() < new \DateTime($slot->date . $slot->end_time)) {
                        error_log("Hasnt finished yet");
                        array_push($finalTimeSlots, $slot);
                        error_log($slot);
                    }
                }
//                error_log(new \DateTime()." ". new \DateTime($slot->date.$slot->end_time)." ". new \DateTime($slot->date.$slot->start_time));

            }
        }
        return  view('auth.viewMySlots')->with('slots',$finalTimeSlots);


    }
    public function teacherMySlot($id){
        error_log("ID is ".$id);
        $students = DB::table('users')->join('slot__students','users.id','=','slot__students.student_id')->where('slot_id','=',$id)->select('users.email','users.name','slot__students.student_id')->get();
        $conversations= DB::table('conversations')->join('conver_users','conver_users.conver_id','=','conversations.id')->where('conver_users.user_id','=',Auth::user()->id)->where('conversations.slot_id','=',$id)->select('conversations.id','conversations.type','conversations.quiz_id')->get();
        $quizResults=[];
        foreach ($conversations as $con){
            $studentQuiz=DB::table('student_quizzes')->join('users','users.id','student_quizzes.student_id')->where('student_quizzes.quiz_id','=',$con->quiz_id)->where('users.type','=','student')->get();
//            $studentQuiz->name=User::where('user_id','=',$studentQuiz->id);
            array_push($quizResults,$studentQuiz);
        }

        error_log( 'cons are'.sizeof($conversations));
        return  view('auth.mySlot')->with('teacher',True)->with('students',$students)->with('conver',$conversations)->with('slot_id',$id)->with('marks',$quizResults);
    }

    //view Student timeslots.
    protected function viewStudentslots(Request $request){
        $data=$request->all();
        $user_id=Auth::user()->id;
        error_log('userid'.$user_id);
        $timeslots =DB::table('time_slots')->join('slot__students','slot__students.slot_id','=','time_slots.id')->where('slot__students.student_id','=',$user_id)->select('time_slots.id','start_time','end_time','date')->get();
        //check whether they are active
        $finalTimeSlots=[];
        date_default_timezone_set("Asia/Colombo");
        foreach ($timeslots as $slot){
            if (new \DateTime() > new \DateTime($slot->date.$slot->end_time)) {
                error_log("Found a past time");
                $timeslot=TimeSlot::where('id','=',$slot->id)->get()[0];
                $timeslot->status="deactive";
                $timeslot->save();
            }
            else{
                array_push($finalTimeSlots, $slot);
            }
        }
        return  view('auth.viewMySlotsStudent')->with('slots',$finalTimeSlots);


    }

    //student gets the conversations.
    public function getStudentConversations($id){

        //get all the active conversations for the bugger
        $conversations= DB::table('conversations')->join('conver_users','conver_users.conver_id','=','conversations.id')->where('conver_users.user_id','=',Auth::user()->id)->where('conversations.status','=','active')->where('slot_id','=',$id)->select('conversations.id','conversations.type')->get();
        error_log( 'cons are'.sizeof($conversations));
        return  view('auth.mySlot')->with('conver',$conversations)->with('slot_id',$id);
    }

//DB::table('conversations')->join('conver_users','conver_users.conver_id','=','conversations.conver_id')->where('conver_users.user_id','=',9)->where('conversations.slot_id','=',1)->get();

}
