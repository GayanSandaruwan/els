<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Slot_Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    protected function slotRequestValidator(array $data)
    {
        return Validator::make($data, [
            'reason' => ['required', 'string']
        ]);
    }

    //view the quizes
    public function viewQuiz(Request $request){
//                var_dump($request);
//        $this->studentParentValidator($request->all())->validate();
//
//        $student_parent = $this->createStudentParentRelation($request->all());

//        return redirect()->route('addTimeSlotForm');

        return view('auth.quiz');
    }
    public function getSubmitRequest(Request $request){

        return view('auth.studentRequest');
    }
    public function submitTimeRequest(Request $request){
        $this->slotRequestValidator($request->all())->validate();
        $reason=$request->all()['reason'];
        error_log($reason);
        $new_request = Slot_Requests::create([
            'user_id' => Auth::user()->id,
            'reason' => $reason
        ]);
        return view('auth.studentRequest')->with('new_request',$new_request);
    }
    public function viewTimeSlotRequests(Request $request){
        //
        $new_requests = Slot_Requests::where('status', '=', "active")->get();
        return view('auth.ViewSlotRequests')->with('requests',$new_requests);
    }
    public function markasread(Request $request){
        //
        $id=$request->all()['id'];
        $request = Slot_Requests::where('id', '=', $id)->get();
        $request[0]->status='read';
        $request[0]->save();
        error_log('*****************************'); error_log($request);
        $new_requests = Slot_Requests::where('status', '=', "active")->get();
        return view('auth.studentRequest')->with('new_requests',$new_requests);
    }


}
