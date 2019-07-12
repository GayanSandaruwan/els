<?php

namespace App\Http\Controllers;

use App\Parentc;
use App\Student;
use App\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentParentController extends Controller
{
    //

    protected function studentParentValidator(array $data)
    {
        return Validator::make($data, [
            'student_id' => ['required', 'numeric', 'exists:students,id'],
            'parent_id' => ['required', 'numeric','exists:parentcs,id'],
            'relationship' => ['required', 'string', 'min:4'],
        ]);
    }

    protected function createStudentParentRelation(array $data)
    {
//        var_dump($user);

        return StudentParent::create([
            'student_id' => $data['student_id'],
            'parent_id' => $data['parent_id'],
            'relationship' => $data['relationship'],
        ]);
    }

    public function getAssignStudentForm(Request $request){
//        var_dump($request);
        $students = DB::table('users')->join('students','users.id','=','students.user_id')
            ->select('users.email','users.name','students.id')->get();
        $parents = DB::table('users')->join('parentcs','users.id','=','parentcs.user_id')
            ->select('users.email','users.name','parentcs.id')->get();

//        echo $students;
//        echo $parents;
        return view('auth.studentToParent')->with('students',$students)->with('parents',$parents);
    }

    public function assignStudent(Request $request){
//                var_dump($request);
        $this->studentParentValidator($request->all())->validate();

        $student_parent = $this->createStudentParentRelation($request->all());

        return $this->getAssignStudentForm($request)->with("");
    }
}
