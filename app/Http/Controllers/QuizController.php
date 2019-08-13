<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Conversations;
use App\Mail\TeacherRegistered;
use App\Parentc;
use App\Question;
use App\Quiz;
use App\Student;
use App\StudentParent;
use App\StudentQuiz;
use App\TimeSlot;
use App\User;
use Illuminate\Auth\Events;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Events\MyEvent;



class QuizController extends Controller
{

    protected function quizValidator(array $data)
    {
        return Validator::make($data, [
            'quizName' => ['required', 'string', 'max:255'],
            'fileToUpload' => ['required', 'file', 'max:1024', 'unique:users']]);
    }

    public function getUploadQuiz(Request $request)
    {
        $students=User::select('id','name')->where('type','=','student')->get();

        return view('auth.uploadQuiz')->with('students',$students);

    }

    public function uploadQuiz(Request $request)
    {

      try {
          session()->forget('new_quiz');
          session()->forget('error');
//        $this->quizValidator($request->all())->validate();
          $data = $request->all();

          //quiz name
          $quizName = $data['quizName'];
          $csv = $data['fileToUpload'];
          $student_ids = $data['students'];
          $unit=$data['unit'];


          //adding timestamp to the file
          $fileName = "fileName" . time() . '.' . $csv->getClientOriginalExtension();
          //saving the file
          $csv->storeAs('quiz', $fileName);

          error_log("this is the path " . gettype($fileName));
          $path = "app\quiz\\" . $fileName;

          $questions = $this->readCSV(storage_path($path));

          //saving in the database
          //quiz

          $quiz = Quiz::create([
              'quiz_name' => $quizName,
              'created_by' => Auth::user()->name,
              'url' => strtotime(date("Y-m-d H:i:s")),
              'unit'=>$unit
          ]);
          error_log($quiz->quiz_id);
          //questions
          $firstElement = true;
          foreach ($questions as $value) {
              if ($firstElement) {
                  $firstElement = false;
              } else {
                  $que = Question::create([
                      'quiz_id' => $quiz->id,
                      'question' => $value[0],
                      'A' => $value[1],
                      'B' => $value[2],
                      'C' => $value[3],
                      'D' => $value[4],
                      'anzwer' => $value[5],
                  ]);
              }
          }
//        $students = Student::select('user_id')->get();

//        $students = StudentQuiz::select('user_id')->where('quiz_id','=',$quiz->id)->get();
          //updating studnet quiz table
//        foreach ($students as $stud) {
//            StudentQuiz::create([
//                'quiz_id' => $quiz->id,
//                'student_id' => $stud->user_id,
//                'mark' => 'N/A',
//                'attempt_allowed' => 1,
//                'attempt' => 0
//            ]);
//        }
          foreach ($student_ids as $studID) {
              StudentQuiz::create([
                  'quiz_id' => $quiz->id,
                  'student_id' => $studID,
                  'mark' => 0,
                  'attempt_allowed' => 1,
                  'attempt' => 0
              ]);
          }
//        view('auth.uploadQuiz')
//        return  view('auth.uploadQuiz')->with('new_quiz', $quiz);;

          return redirect()->route('uploadQuiz')->with('new_quiz', $quiz);;

      }catch (Exception $e) {
          error_log(    $e);
          return redirect()->route('uploadQuiz')->with('error', True);;
//          return false;
      }
    }


    //chatQuiz



    public function uploadQuizChat(Request $request)
    {

        session()->forget('new_quiz');
        session()->forget('error');
        $student_ids=$request->session()->get('students');
//        $this->quizValidator($request->all())->validate();
        $data = $request->all();
        error_log("YOU BIT");
//            error_log($data[0]);
        //quiz name
        $quizName = $data['quizName'];
        $csv = $data['fileToUpload'];
//        $student_ids = \Session::get('students');

        $time=$data['quizTime'];
        date_default_timezone_set("Asia/Colombo");
        $curr_time=date("Y/m/d H:i:s");
        error_log($curr_time);
        $curr_time=strtotime('+'.$time." minutes", strtotime($curr_time));
        error_log($curr_time." This is the current time");

        //adding timestamp to the file
        $fileName = "fileName" . time() . '.' . $csv->getClientOriginalExtension();
        //saving the file
        $csv->storeAs('quiz', $fileName);
        $path = "app\quiz\\" . $fileName;

        $questions = $this->readCSV(storage_path($path));

        $quiz = Quiz::create([
            'quiz_name' => $quizName,
            'created_by' => Auth::user()->name,
            'url' => strtotime(date("Y-m-d H:i:s")),
            'type'=>'live'
        ]);

        error_log($quiz->id." This is the quiz id");
        //questions
        $firstElement = true;
        foreach ($questions as $value) {
            if ($firstElement) {
                $firstElement = false;
            } else {
                $que = Question::create([
                    'quiz_id' => $quiz->id,
                    'question' => $value[0],
                    'A' => $value[1],
                    'B' => $value[2],
                    'C' => $value[3],
                    'D' => $value[4],
                    'anzwer' => $value[5],
                ]);
            }
        }
//        error_log($student_ids['users']);
        error_log(sizeof((array)$student_ids));
        print_r($student_ids);
        foreach ($student_ids as $studID) {
            error_log(" In the first Item".$studID);
            StudentQuiz::create([
                'quiz_id' => $quiz->id,
                'student_id' => $studID->user_id,
                'mark' => 0,
                'attempt_allowed' => 1,
                'attempt' => 0,
                'time'=>$curr_time,
                'type'=>'live'
            ]);
        }

        $conv=Conversations::where("id",'=',$data['con_id'])->get()[0];
        $conv->quiz_id=$quiz->id;
        $conv->save();
        return $quiz->id;

    }

    protected function readCSV($filename)
    {
        error_log($filename);
        $file = fopen($filename, "r");
        $all_data = array();
        while (($line = fgetcsv($file)) !== FALSE) {
            array_push($all_data, $line);
        }
        fclose($file);
        return $all_data;
    }

    public function createQuiz(Request $request)
    {

        $this->parentValidator($request->all())->validate();

        event(new Registered($user = $this->createStudentUser($request->all())));

//        var_dump($user);
        $this->createParent($request->all(), $user->id);

        //Sending notification email
        $email = new TeacherRegistered($user->email, $request->password);

        Mail::to($user)->send($email);

        return $this->registered($request, $user->id)
            ?: view('auth.registerParent')->with('new_user', $user);
    }

    public function getUploadAss()
    {
        return view('auth.uploadAssingnment');
    }

    public function uploadAss(Request $request)
    {
        session()->forget('new_ass');
        $data = $request->all();
        $assName = $data['assName'];
        $pdf = $data['fileToUpload'];
        //adding timestamp to the file
        $fileName = "fileName" . time() . '.' . $pdf->getClientOriginalExtension();
        $pdf->storeAs('public\assignment', $fileName);
//        $path = storage_path($path);
        $path = 'assignment/' . $fileName;
        $unit= $data['unit'];
        error_log("This is the unit number ".$unit);
        error_log($path);
        $assignment = Quiz::create([
            'quiz_name' => $assName,
            'path' => $path,
            'type' => "assignment",
            'unit'=>$unit,
            'created_by' => Auth::user()->name

        ]);
        return redirect()->route('uploadAss')->with('new_ass', $assignment);
    }
    public function getUploadLesson()
    {
        return view('auth.uploadLesson');
    }
    public function uploadLesson(Request $request)
    {
        session()->forget('new_ass');
        $data = $request->all();
        $assName = $data['assName'];
        $pdf = $data['fileToUpload'];
        //adding timestamp to the file
        $fileName = "fileName" . time() . '.' . $pdf->getClientOriginalExtension();
        $pdf->storeAs('public\assignment', $fileName);
//        $path = storage_path($path);
        $path = 'assignment/' . $fileName;
        $unit= $data['unit'];
        error_log("This is the unit number ".$unit);
        error_log($path);
        $assignment = Quiz::create([
            'quiz_name' => $assName,
            'path' => $path,
            'type' => "lessons",
            'unit'=>$unit,
            'created_by' => Auth::user()->name

        ]);
        return redirect()->route('uploadLesson')->with('new_ass', $assignment);
    }

    public function viewAssignment(Request $request)
    {
        $assignments = Quiz::where('status', '=', "active")->where('type', '=', "assignment")->get();
        error_log(count($assignments) . "This is the damn id");
        //changing to real file path
        foreach ($assignments as $ass) {
            $ass['path'] = Storage::url($ass['path']);
//            return Storage::download($ass['path']);
        }

        return view('auth.viewAssignments')->with('assignments', $assignments);

    }
    public function viewLessons(Request $request)
    {
        $assignments = Quiz::where('status', '=', "active")->where('type', '=', "lessons")->get();
        error_log(count($assignments) . "This is the damn id");
        //changing to real file path
        foreach ($assignments as $ass) {
            $ass['path'] = Storage::url($ass['path']);
//            return Storage::download($ass['path']);
        }

        return view('auth.viewLessons')->with('assignments', $assignments);

    }

    public function viewQuizzes(Request $request)
    {
        $quizzes = Quiz::where('type', '=', "quiz")->get();
        $marks=[];
        foreach ($quizzes as $quiz){
          $studnetQuiz=DB::table('student_quizzes')->join('users','users.id','student_quizzes.student_id')->where('quiz_id','=',$quiz->id)->select('student_quizzes.updated_at','mark','attempt','users.name','users.id')->get();
          array_push($marks,$studnetQuiz);
        }
//        var_dump($studnetQuiz);
        return view('auth.viewQuizzes')->with('quizzes', $quizzes)->with('studnetQuiz',$marks);

    }

    public function viewLiveQuizes(Request $request)
    {
        $quizzes = Quiz::where('type', '=', "quiz")->get();
        $marks=[];
        foreach ($quizzes as $quiz){
            $studnetQuiz=DB::table('student_quizzes')->join('users','users.id','student_quizzes.student_id')->where('quiz_id','=',$quiz->id)->select('student_quizzes.updated_at','mark','attempt','users.name','users.id')->get();
            array_push($marks,$studnetQuiz);
        }
//        var_dump($studnetQuiz);
        return view('auth.viewLiveQuizzes')->with('quizzes', $quizzes)->with('studnetQuiz',$marks);

    }

    //student sees all the quizzes here.
    public function studentViewQuizzes(Request $request)
    {
        $myQuizzes = [];
//        $quizzes = Quiz::select('id')->where('type', '=', "quiz")->where('status', '!=', "active")->get()->toArray();
        $quizzes = DB::table('quizzes')->join('student_quizzes','quizzes.id','=','student_quizzes.quiz_id')->where('student_quizzes.student_id','=',Auth::user()->id)->get();
        $comments=[];
//        $std_quizzes = StudentQuiz::where('student_id', '=', Auth::user()->id)->get();
        error_log(gettype($quizzes)."How are tyou");
        foreach ($quizzes as $stu_Q) {
            //get parent
            $student_id=Student::where('user_id','=',Auth::user()->id)->select('id')->get()[0]['id'];
            $parent_id=StudentParent::where('student_id','=',$student_id)->get()[0]['parent_id'];
            $parent_user_id=Parentc::where('id','=',$parent_id)->get()[0]['user_id'];
            $my_comments=Comment::where('user_id','=',$parent_user_id)->where('student_quiz_id','=',$stu_Q->id)->get();
            array_push($comments,$my_comments);
            if ($stu_Q->attempt == 0) {
                if (in_array($stu_Q->quiz_id, (array)$quizzes)) {
                    echo "found a deactivated unattempted one";
                    //not attempted and not active
                    //remove this case from viewing
                }
                //not attempted and active
                $stu_Q->active = True;
//                $quiz_details = Quiz::select('url', 'quiz_name')->where('id', '=', $stu_Q->quiz_id)->get()->toArray()[0];
//                $stu_Q['url'] = $quiz_details['url'];
//                $stu_Q['quiz_name'] = $quiz_details['quiz_name'];
                array_push($myQuizzes, $stu_Q);
            } else {
                //attempted and not active
                if (in_array($stu_Q->quiz_id,(array) $quizzes))
                {
//                    $stu_Q->active=False;
//                    array_push($myQuizzes,$stu_Q);
                }
//                //attempted and active
                $stu_Q->active = False;
                array_push($myQuizzes, $stu_Q);
            }
        }
        error_log(count($myQuizzes));
        return view('auth.viewMyQuizzes')->with('quizzes', $myQuizzes)->with('comments',$comments);

    }

    //live quizzes
    public function studentViewLiveQuizzes(Request $request)
    {
        date_default_timezone_set("Asia/Colombo");
        $myQuizzes = [];
//        $quizzes = Quiz::select('id')->where('type', '=', "quiz")->where('status', '!=', "active")->get()->toArray();
        $quizzes = DB::table('quizzes')->join('student_quizzes','quizzes.id','=','student_quizzes.quiz_id')->where('quizzes.type','=','live')->where('student_quizzes.student_id','=',Auth::user()->id)->get();
        $comments=[];
//        $std_quizzes = StudentQuiz::where('student_id', '=', Auth::user()->id)->get();
        error_log(gettype($quizzes)."How are tyou");
        foreach ($quizzes as $stu_Q) {
            //get parent
//            var_dump($stu_Q->time);
//            var_dump(strtotime(date("Y/m/d H:i:s")));
            if($stu_Q->time>strtotime(date("Y/m/d H:i:s"))) {
                $student_id = Student::where('user_id', '=', Auth::user()->id)->select('id')->get()[0]['id'];
//            $parent_id=StudentParent::where('student_id','=',$student_id)->get()[0]['parent_id'];
//            $parent_user_id=Parentc::where('id','=',$parent_id)->get()[0]['user_id'];
//            $my_comments=Comment::where('user_id','=',$parent_user_id)->where('student_quiz_id','=',$stu_Q->id)->get();
//            array_push($comments,$my_comments);
                if ($stu_Q->attempt == 0) {
                    if (in_array($stu_Q->quiz_id, (array)$quizzes)) {
                        echo "found a deactivated unattempted one";
                        //not attempted and not active
                        //remove this case from viewing
                    }
                    //not attempted and active
                    $stu_Q->active = True;
//                $quiz_details = Quiz::select('url', 'quiz_name')->where('id', '=', $stu_Q->quiz_id)->get()->toArray()[0];
//                $stu_Q['url'] = $quiz_details['url'];
//                $stu_Q['quiz_name'] = $quiz_details['quiz_name'];
                    array_push($myQuizzes, $stu_Q);
                } else {
                    //attempted and not active
                    if (in_array($stu_Q->quiz_id, (array)$quizzes)) {
//                    $stu_Q->active=False;
//                    array_push($myQuizzes,$stu_Q);
                    }
//                //attempted and active
                    $stu_Q->active = False;
                    array_push($myQuizzes, $stu_Q);
                }
            }
        }
        error_log(count($myQuizzes));
        return view('auth.viewMyLiveQuizzes')->with('quizzes', $myQuizzes);

    }

    public function parentViewQuizzes($id)
    {
        $myQuizzes = [];
        $student_id=$id;
        $stu_user_id=Student::where('id','=',$id)->select('user_id')->get()[0]['user_id'];
        $quizzes = DB::table('quizzes')->join('student_quizzes','quizzes.id','=','student_quizzes.quiz_id')->where('student_quizzes.student_id','=',$stu_user_id)->select('created_by','status','mark','attempt','quiz_id','quiz_name','student_quizzes.id')->get();
        $comments=[];
        foreach ($quizzes as $stu_Q) {
            $my_comments=Comment::where('user_id','=',Auth::user()->id)->where('student_quiz_id','=',$stu_Q->id)->get();
            array_push($comments,$my_comments);
            if ($stu_Q->attempt == 0) {
                if (in_array($stu_Q->quiz_id, (array)$quizzes)) {
                    echo "found a deactivated unattempted one";
                    //not attempted and not active
                    //remove this case from viewing
                }
                //not attempted and active
                $stu_Q->active = True;
//                $quiz_details = Quiz::select('url', 'quiz_name')->where('id', '=', $stu_Q->quiz_id)->get()->toArray()[0];
//                $stu_Q['url'] = $quiz_details['url'];
//                $stu_Q['quiz_name'] = $quiz_details['quiz_name'];

            } else {
                //attempted and not active
                if (in_array($stu_Q->quiz_id,(array) $quizzes))
                {
                    $stu_Q->activate=False;
                    array_push($myQuizzes,$stu_Q);
                }
//                //attempted and active
                array_push($comments,$my_comments);
                $stu_Q->active = False;
            }
            array_push($myQuizzes, $stu_Q);
        }
        error_log(count($myQuizzes));
        return view('auth.viewMyChildQuizzes')->with('quizzes', $myQuizzes)->with('comments',$comments);

    }

    public function updateQuiz(Request $request)
    {
        $data=$request->all();
        $id=$data['id'];
        $state=$data['newState'];
        if($state=='active'){
            $quiz=Quiz::where('id','=',$id)->get()[0];
            $quiz->status='acitve';
            $quiz->save();
        }
        else{
            error_log($id);
            $quiz=Quiz::where('id','=',$id)->get()[0];
            $quiz->status='deactivate';
            $quiz->save();
        }
        return ($this->viewQuizzes($request));

    }

    public function viewQuiz($id, Request $request)
    {
        $quizzes = Quiz::where('url', '=', "$id")->get();
        error_log("Quiz Id" . $id);

        $questions = Question::select('id', 'question', 'A', 'B', 'C', 'D')->where('quiz_id', '=', $quizzes[0]->id)->get();

        error_log($id . "this is thd fdfe damn Id" . count($questions));

        return view('auth.quiz')->with('questions', $questions)->with('url', $id);


    }
    public function submitLiveQuiz(Request $request)
    {
//        Auth::user()->name
        $data = $request->all();
        $quizUrl = $data['quizUrl'];
        unset($data["quizUrl"]);

        //marking the anzwers
        $quizz = Quiz::where('type', '=', "live")->where('url', '=', $quizUrl)->get()[0];
        $questions = Question::where('quiz_id', '=', $quizz->id)->get();
        $num_ques = sizeof($questions);


        $marks = 0;
        foreach ($questions as $q) {
            error_log($q->id);
            if (array_key_exists($q->id, $data)) {
                if ($data[$q->id] == $q->anzwer) {
                    $marks += 1;
                }
                error_log($data[$q->id] . " Found the question " . $q->anzwer);
            }
        }
        //getting the presentage
        error_log(($marks / $num_ques) * 100 . "  this is marks");

        //updating the user marks
        date_default_timezone_set("Asia/Colombo");
        $my_quiz = StudentQuiz::where('student_id', '=', Auth::user()->id)->where('quiz_id','=',$quizz->id)->get()[0];
        if( strtotime($curr_time=date("Y/m/d H:i:s"))>$my_quiz->time){
            return redirect()->route('home');
        }
        $my_quiz->mark = ($marks / $num_ques) * 100 ;
        $my_quiz->mark = ($marks / $num_ques) * 100 ;
        $my_quiz->attempt = 1;
        $my_quiz->save();

        return redirect()->route('home')->with('submitted', True)->with('quiz_mark',($marks / $num_ques) * 100)->with('quiz_name',$quizz->quiz_name);

    }


    public function submitQuiz(Request $request)
    {
//        Auth::user()->name
        $data = $request->all();
        $quizUrl = $data['quizUrl'];
        unset($data["quizUrl"]);

        //marking the anzwers
        $quizz = Quiz::where('type', '=', "quiz")->where('url', '=', $quizUrl)->get()[0];
        $questions = Question::where('quiz_id', '=', $quizz->id)->get();
        $num_ques = sizeof($questions);


        $marks = 0;
        foreach ($questions as $q) {
            error_log($q->id);
            if (array_key_exists($q->id, $data)) {
                if ($data[$q->id] == $q->anzwer) {
                    $marks += 1;
                }
                error_log($data[$q->id] . " Found the question " . $q->anzwer);
            }
        }
        //getting the presentage
        error_log(($marks / $num_ques) * 100 . "  this is marks");

        //updating the user marks
        $my_quiz = StudentQuiz::where('student_id', '=', Auth::user()->id)->where('quiz_id','=',$quizz->id)->get()[0];
        $my_quiz->mark = ($marks / $num_ques) * 100 ;
        $my_quiz->mark = ($marks / $num_ques) * 100 ;
        $my_quiz->attempt = 1;
        $my_quiz->save();

        return redirect()->route('home')->with('submitted', True)->with('quiz_mark',($marks / $num_ques) * 100)->with('quiz_name',$quizz->quiz_name);

    }
    public function getMarks($id){
        $stu=DB::table(quizzes)->join('student_quizzes','quizzes.id,student_quizzes.id','quizzes.id')->where('quiz.id','=',$id)->where('type','=','live')->get();
        return $stu;
    }

}

