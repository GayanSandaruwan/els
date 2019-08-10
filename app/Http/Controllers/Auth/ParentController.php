<?php

namespace App\Http\Controllers\Auth;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Parentc;
use App\Slot_Requests;
use App\StudentParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{

   public function getChildren(){
       $parent_id=Parentc::where('user_id','=',Auth::user()->id)->get()[0]->id;
       $children=DB::table('student_parents')->select('name','users.id')->join('users','users.id','student_parents.student_id')-> where('parent_id','=',$parent_id)->get();

//       error_log(Auth::user()->id);
       return view('auth.viewMyChildren')->with('children',$children);
   }
   public function addComment(Request $request){
       $data=$request->all();
//        error_log("Got something");
        $comment=Comment::create([
            'user_id'=>Auth::user()->id,
            'úser_name'=>Auth::user()->name,
            'student_quiz_id'=>$data['student_quiz_id'],
            'comment'=>$data['comment']
        ]);
       return response()->json(array('id'=> $data['student_quiz_id'],'comment'=>$data['comment'],'úser_name'=>Auth::user()->name,'created_at'=>$comment->created_at), 200);

   }
}
