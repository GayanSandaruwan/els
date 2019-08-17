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

        $students=DB::table('slot__requests')->join('users','users.id','slot__requests.user_id')->select('user_id','reason','slot__requests.id','email')->where('status', '=', 'active')->get();
//        Slot_Requests::select('user_id','reason')->where('status', '=', 'active')->get();

        //getting all the timeslots and deactivate the old ones.
        $timeslots = TimeSlot::where('status', '=', 'active')->get();
        date_default_timezone_set("Asia/Colombo");
        foreach ($timeslots as $slot){
            if (new \DateTime() > new \DateTime($slot->date." ".$slot->end_time)) {
              error_log("Found a past time");
                $timeslot=TimeSlot::where('id','=',$slot->id)->get()[0];
                $timeslot->status="deactive";
                $timeslot->save();
            }
        }
        //getting the active timeslots
        $timeslots = TimeSlot::where('status', '=', 'active')->get();
        $teachers = DB::table('users')->join('teachers','users.id','=','teachers.user_id')
            ->where('statuss','=','active')->get();

        return view('auth.addToTimeSlot')->with('students',$students)->with('slots',$timeslots)->with('teachers',$teachers);
    }
    protected function assignStudentToSlot(Request $request){
        $data=$request->all();
        $students=$request['students'];
        $timeSlot=TimeSlot::where('id','=',$request['slot'])->where('status','=','active')->get()[0];


        foreach ($students as $student){
            $values=explode("-",$student);
            Slot_Student::create([
                    'student_id'=>$values[0],
                    'slot_id'=>$request['slot']
            ]);
            $request=Slot_Requests::where('id','=',$values[1])->get()[0];
            $request->status='read';
            $request->save();
            //deactivating the request

            //Sending notification email to students
            $user=User::where('id','=',$student)->get()[0];
            $email = new SlotAlert($timeSlot->date,$timeSlot->start_time,$timeSlot->end_time,$timeSlot->duration);
            Mail::to($user)->send($email);
        }

        $timeSlot->teacher=$data['teacher'];
        error_log($request['teacher']);
        //sending emails.
        $user=User::where('id','=',$data['teacher'])->get()[0];
        $teacher_email = new SlotAlert($timeSlot->date,$timeSlot->start_time,$timeSlot->end_time,$timeSlot->duration);
        Mail::to($user)->send($teacher_email);

        $timeSlot->save();
        return redirect()->route('studentToSlot')->with('success_stu_add',True);
    }


    public function geteditDeleteTeacherForm(Request $request){
        $teachers = DB::table('users')->join('teachers','users.id','=','teachers.user_id')
            ->where('statuss','=','active')->select('users.email','users.name','users.id')->get();

        return view('auth.editDeleteTeacherForm')->with('teachers',$teachers);

    }
    public function editTeacherForm(Request $request){
        $data=$request->all();
        $teacher=$data['teacher'];
        $request->session()->put('teacher',$teacher);
        $user=User::where('id','=',$teacher)->get()[0];
        $change=$data['change'];
        if($change=='edit'){
            $teacher_details = DB::table('users')->join('teachers','users.id','=','teachers.user_id')
                ->where('statuss','=','active')->where('user_id','=',$teacher)->get()[0];


            return view('auth.editeacher')->with('teacher',$teacher_details);
        }
        if($change=='delete'){
            $user->statuss='inactive';
            $user->save();
            return $this->geteditDeleteTeacherForm($request)->with('edited',True);
        }



    }
    public function editTeacher(Request $request){
        $teacherId= $request->session()->get('teacher');
        error_log($teacherId." Teacher ID");
        $teacher=Teacher::where('user_id','=',$teacherId)->get()[0];
        $data=$request->all();

        error_log($data['nic']);
        $teacher->nic= $data['nic'];
        $teacher->address= $data['address'];
        $teacher->edu_qual= $data['edu_qual'];
        $teacher->prof_qual= $data['prof_qual'];
        $teacher->specialization= $data['specialization'];
        $teacher->contact= $data['contact'];
        $teacher->save();

        $teacher_details = DB::table('users')->join('teachers','users.id','=','teachers.user_id')
            ->where('statuss','=','active')->where('user_id','=',$teacherId)->get()[0];

        $request->session()->put('teacher',$teacher);
        return view('auth.editeacher')->with('teacher',$teacher_details)->with('saved',True);
    }
    public function geteditDeleteStudentForm(Request $request){
        $students = DB::table('users')->join('students','users.id','=','students.user_id')
            ->where('statuss','=','active')->select('users.email','users.name','users.id')->get();

        return view('auth.editDeleteStudentForm')->with('students',$students);

    }
    public function editStudentForm(Request $request){
        $data=$request->all();
        $student=$data['student'];
        $request->session()->put('student',$student);
        error_log( $request->session()->get('student')." dddddddddddddfd");
        $user=User::where('id','=',$student)->get()[0];
        $change=$data['change'];
        if($change=='edit'){
            $student_details = DB::table('users')->join('students','users.id','=','students.user_id')
                ->where('statuss','=','active')->where('user_id','=',$student)->get()[0];


            return view('auth.editstudent')->with('student',$student_details);
        }
        if($change=='delete'){
            $user->statuss='inactive';
            $user->save();
            return $this->geteditDeleteStudentForm($request)->with('edited',True);
        }



    }
    public function editStudent(Request $request){
//        var_dump(session());
        $studentId= $request->session()->get('student');
//        error_log($studentId." Teacher ID");
        $student=Student::where('user_id','=',$studentId)->get()[0];
        $data=$request->all();

        $student->grade= $data['grade'];
        $student->address= $data['address'];
        $student->contact= $data['contact'];
        $student->dob=date('Y-m-d',strtotime($data['dob']));
        $student->save();

        $student_details = DB::table('users')->join('students','users.id','=','students.user_id')
            ->where('statuss','=','active')->where('user_id','=',$studentId)->get()[0];

        $request->session()->put('student',$student);
        return view('auth.editStudent')->with('student',$student_details)->with('saved',True);
    }



}
