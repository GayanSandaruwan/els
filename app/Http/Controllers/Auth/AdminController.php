<?php

namespace App\Http\Controllers\Auth;

use App\Mail\SlotAlert;
use App\Mail\TeacherRegistered;
use App\Parentc;
use App\Slot_Requests;
use App\Slot_Student;
use App\Student;
use App\Teacher;
use App\TimeSlot;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use mysql_xdevapi\Session;

class AdminController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function slotValidator(array $data)
    {
        return Validator::make($data, [
            'date' => ['required', 'DATE'],
            'duration' => ['required', 'numeric'],
            'no_of_slots' => ['required', 'numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function getAddTimeSlot(Request $request){
//        var_dump($request);
        return view('auth.createTimeSlot');
    }


    protected function createTimeSlot(Request $request)
    {
        session()->forget('new_slot');
        $this->slotValidator($request->all())->validate();
        $data=$request->all();
        $date=explode('T',$data['date']);
        $time= explode(':',$date[1]);
        $curr_time=strtotime("+15 minutes", strtotime($date[1]));
        error_log($date[0]);
//        error_log(gmdate("Y-m-d\TH:i:s\Z", $curr_time));
        $timeSlot=TimeSlot::create([
            'date' => $date[0],
            'start_time' => $date[1],
            'end_time' => gmdate("H:i", $curr_time),
//            'end_time' => gmdate("Y-m-d\TH:i:s\Z", $curr_time),
            'no_of_slots' => $data['no_of_slots'],

        ]);
        var_dump($timeSlot);
//        return  view('auth.createTimeSlot')->with('$new_slot',$timeSlot);
//        Session::
        return redirect()->route('addTimeSlotForm')->with('new_slot',$timeSlot);;
    }

    public function getStudentToTimeSlot(Request $request){

        $students = DB::table('users')->join('students','users.id','=','students.user_id')
            ->select('users.email','users.name','students.id')->get();

        $students=Slot_Requests::select('user_id','reason')->where('status', '=', 'active')->get();

        //getting all the timeslots and deactivate the old ones.
        $timeslots = TimeSlot::where('status', '=', 'active')->get();
        foreach ($timeslots as $slot){
            if (new \DateTime() > new \DateTime($slot->date.$slot->end_time)) {
              error_log("Found a past time");
              $slot->status="deactive";
                $slot->save();
            }
        }
        //getting the active timeslots
        $timeslots = TimeSlot::where('status', '=', 'active')->get();
        $teachers = DB::table('users')->join('teachers','users.id','=','teachers.user_id')
            ->select('users.email','users.name','users.id')->get();

        return view('auth.addToTimeSlot')->with('students',$students)->with('slots',$timeslots)->with('teachers',$teachers);
    }
    protected function assignStudentToSlot(Request $request){
        $data=$request->all();
        $students=$request['students'];
        $timeSlot=TimeSlot::where('id','=',$request['slot'])->get()[0];
        foreach ($students as $student){
            Slot_Student::create([
                    'student_id'=>$student,
                    'slot_id'=>$request['slot']
            ]);
            //Sending notification email
            $user=User::where('id','=',$student)->get()[0];
            $email = new SlotAlert($timeSlot->date,$timeSlot->start_time,$timeSlot->end_time,$timeSlot->duration);
            Mail::to($user)->send($email);
        }

        $timeSlot->teacher=$request['teacher'];
        error_log($request['teacher']);
        //sending emails.
        $teacher_email = new SlotAlert($timeSlot->date,$timeSlot->start_time,$timeSlot->end_time,$timeSlot->duration);
        Mail::to($user)->send($teacher_email);

        $timeSlot->save();
        return redirect()->route('studentToSlot')->with('$success_stu_add',True);
    }


}
