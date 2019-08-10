<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//user App

use App\Events\MyEvent;

Route::get('/', function () {
    return redirect('home');
});

//Route::post('/test', function ($request) {
//      error_log("Inside the post");
////    $text = $request->get('text');
////    event(new \App\Events\MyEvent($text));
//    return "Event has been sent!";
//});


//Route::get('test/{text}', function ($request) {
////    $data = $request->all();
////    $text = $data['text'];
//    error_log("Inside the get");
//    event(new \App\Events\MyEvent("DFDF"));
//
//    return "Event has been sent!";
//});

Route::get('/chat', function () {
    return view('auth.chat');
});


Auth::routes();

//send

//view




Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/addTeacher', 'Auth\RegisterController@getAddTeacherForm')->name('addTeacherForm');
    Route::post('/admin/addTeacher','Auth\RegisterController@registerTeacher')->name('addTeacher');

    Route::get('/admin/addStudent', 'Auth\RegisterController@getAddStudentForm')->name('addStudentForm');
    Route::post('/admin/addStudent','Auth\RegisterController@registerStudent')->name('addStudent');

    Route::get('/admin/addParent', 'Auth\RegisterController@getAddParentForm')->name('addParentForm');
    Route::post('/admin/addParent','Auth\RegisterController@registerParent')->name('addParent');

    Route::get('/admin/addTimeSlotForm','Auth\AdminController@getAddTimeSlot')->name('addTimeSlotForm');
    Route::post('/admin/addSlot','Auth\AdminController@createTimeSlot')->name('addSlot');
    Route::get('/admin/viewSlots','Auth\AdminController@viewTimeSlots')->name('viewTimeSlots');
    Route::get('/admin/studentToSlot','Auth\AdminController@getStudentToTimeSlot')->name('studentToSlot');
    Route::post('/admin/assignStudentToSlot','Auth\AdminController@assignStudentToSlot')->name('assignStudentToSlot');
    //view timeslot requests
    Route::get('/admin/viewTimeSlotRequests', 'Auth\StudentController@viewTimeSlotRequests')->name('viewTimeSlotRequests');



});
Route::middleware(['auth','teacher'])->group(function (){

    Route::get('/parent/assignStudent', 'StudentParentController@getAssignStudentForm')->name('studentToParentForm');
    Route::post('/parent/assignStudent', 'StudentParentController@assignStudent')->name('studentToParent');

    Route::get('/teacher/quizController', 'QuizController@getUploadQuiz')->name('uploadQuiz');
    Route::post('/teacher/quizController', 'QuizController@uploadQuiz')->name('uploadQuiz');

    Route::get('/teacher/uploadAssignment', 'QuizController@getUploadAss')->name('uploadAss');
    Route::post('/teacher/uploadAssignment', 'QuizController@uploadAss')->name('uploadAss');
    Route::get('/teacher/viewAssignment', 'QuizController@viewAssignment')->name('viewAssignment');
//    Route::post('/teacher/uploadAssignment', 'QuizController@uploadAss')->name('uploadAss');

    Route::get('/teacher/viewQuizzes', 'QuizController@viewQuizzes')->name('viewQuizzes');
    Route::post('/teacher/updatwQuiz', 'QuizController@updateQuiz')->name('updateQuiz');


    Route::post('/teacher/markasread', 'Auth\StudentController@markasread')->name('markasread');

    Route::get('/teacher/viewmyslots', 'SlotRequestsController@viewmyslots')->name('viewmyslots');
    //get teachers session
    Route::get('/teacher/myslot/{id}', 'SlotRequestsController@teacherMySlot')->name('teacherMySlot');
    //creating a new conversation
    Route::post('/teacher/createConv', 'ConversationsController@createConv')->name('createConv');
    //getting an existing chat
    Route::get('/teacher/getConv/{id}', 'ConversationsController@getConv')->name('getConv');
});

Route::middleware(['auth','parent'])->group(function (){
    Route::get('/parent/viewmystudents', 'Auth\ParentController@getChildren')->name('viewmystudents');
    Route::get('/parent/viewstudent/{id}', 'QuizController@parentViewQuizzes')->name('viewstudent');
    Route::post('/parent/addComment', 'Auth\ParentController@addComment')->name('comment');
});
Route::middleware(['auth'])->group(function (){

//    Route::get('/student/viewQuizes','Auth\StudentController@viewQuiz')->name('viewQuizes');
    Route::get('/student/viewQuizes','QuizController@studentViewQuizzes')->name('viewQuizes');
//    Route::get('/viewMyQuizzes', 'QuizController@studentViewQuizzes')->name('viewMyQuizzes');
    Route::get('/student/quiz/{id}', 'QuizController@viewQuiz')->where('id', '(.*)');
    Route::post('/student/submitQuiz', 'QuizController@submitQuiz')->name('submitQuiz');
    //send
    Route::get('/test1', 'QuizController@test')->name('test1');

//    Route::post('/parent/assignStudent', 'StudentParentController@assignStudent')->name('studentToParent');

    Route::get('/requestTime', 'Auth\StudentController@getSubmitRequest')->name('requestTime');
    Route::post('/submitTimeRequest', 'Auth\StudentController@submitTimeRequest')->name('submitTimeRequest');

    //chatting
    Route::get('/test1', 'ChatController@test')->name('test1');
    Route::post('/chat','ChatController@sendChat')->name('sendChat');

    //getting student timeslots
    Route::get('/student/viewmyslots/','SlotRequestsController@viewStudentslots')->name('getStudentSlots');
    //get all the conversations.
    Route::get('/student/myslot/{id}','SlotRequestsController@getStudentConversations')->name('getStudentConversations');
    //getting an existing chat
    Route::get('/teacher/getConv/{id}', 'ConversationsController@getConv')->name('getConv');
    //view assignments
    Route::get('/teacher/viewAssignment', 'QuizController@viewAssignment')->name('viewAssignment');

});

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/mail',function (){
    return new App\Mail\TeacherRegistered("adafa","asdfasdaf");
})->name('mail');
