<?php

namespace App\Http\Controllers\Auth;

use App\Mail\TeacherRegistered;
use App\Parentc;
use App\Student;
use App\Teacher;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function teacherValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nic' => ['required','string', 'min:9','max:12'],
            'edu_qual' => ['required','string'],
            'address' => ['required','string'],
            'prof_qual' => ['required','string'],
            'specialization' => ['required','string'],
            'contact'=> ['required','string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createTeacherUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => 'teacher',
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createTeacher(array $data, $id)
    {
//        var_dump($user);
        return Teacher::create([
            'nic' => $data['nic'],
            'address' => $data['address'],
            'edu_qual' => $data['edu_qual'],
            'prof_qual' => $data['prof_qual'],
            'specialization' => $data['specialization'],
            'contact' => $data['contact'],
            'user_id' => $id,
        ]);
    }

    public function getAddTeacherForm(Request $request){
//        var_dump($request);
        return view('auth.registerTeacher');
    }

    public function registerTeacher(Request $request){
//                var_dump($request);
        $this->teacherValidator($request->all())->validate();

        event(new Registered($user = $this->createTeacherUser($request->all())));

//        var_dump($user);
        $this->createTeacher($request->all(),$user->id);

        //Sending notification email
        $email = new TeacherRegistered($user->email,$request->password);

        Mail::to($user)->send($email);

        return $this->registered($request, $user->id)
            ?: view('auth.registerTeacher')->with('new_user',$user);
    }


    protected function studentValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'grade' => ['required','numeric', 'min:1','max:13'],
            'dob' => ['required','date'],
            'address' => ['required','string'],
            'contact'=> ['required','string'],
        ]);
    }

    protected function createStudent(array $data, $id)
    {
//        var_dump($user);
        return Student::create([
            'grade' => $data['grade'],
            'address' => $data['address'],
            'contact' => $data['contact'],
            'dob' => date('Y-m-d',strtotime($data['dob'])),
            'user_id' => $id,
        ]);
    }
    protected function createStudentUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => 'student',
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getAddStudentForm(Request $request){
//        var_dump($request);
        return view('auth.registerStudent');
    }

    public function registerStudent(Request $request){
//                var_dump($request);
        $this->studentValidator($request->all())->validate();

        event(new Registered($user = $this->createStudentUser($request->all())));

//        var_dump($user);
        $this->createStudent($request->all(),$user->id);

        //Sending notification email
        $email = new TeacherRegistered($user->email,$request->password);

        Mail::to($user)->send($email);

        return $this->registered($request, $user->id)
            ?: view('auth.registerStudent')->with('new_user',$user);
    }

    protected function parentValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nic' => ['required','string', 'min:9','max:12'],
            'address' => ['required','string'],
            'contact'=> ['required','string'],
        ]);
    }

    protected function createParent(array $data, $id)
    {
//        var_dump($user);
        return Parentc::create([
            'address' => $data['address'],
            'contact' => $data['contact'],
            'nic' => $data['nic'],
            'user_id' => $id,
        ]);
    }
    protected function createParentUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => 'parent',
            'password' => Hash::make($data['password']),
        ]);
    }

    public function getAddParentForm(Request $request){
//        var_dump($request);
        return view('auth.registerParent');
    }

    public function registerParent(Request $request){
//                var_dump($request);
        $this->parentValidator($request->all())->validate();

        event(new Registered($user = $this->createStudentUser($request->all())));

//        var_dump($user);
        $this->createParent($request->all(),$user->id);

        //Sending notification email
        $email = new TeacherRegistered($user->email,$request->password);

        Mail::to($user)->send($email);

        return $this->registered($request, $user->id)
            ?: view('auth.registerParent')->with('new_user',$user);
    }
}
