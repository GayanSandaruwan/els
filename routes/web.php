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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();


Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/addTeacher', 'Auth\RegisterController@getAddTeacherForm')->name('addTeacherForm');
    Route::post('/admin/addTeacher','Auth\RegisterController@registerTeacher')->name('addTeacher');

    Route::get('/admin/addStudent', 'Auth\RegisterController@getAddStudentForm')->name('addStudentForm');
    Route::post('/admin/addStudent','Auth\RegisterController@registerStudent')->name('addStudent');

    Route::get('/admin/addParent', 'Auth\RegisterController@getAddParentForm')->name('addParentForm');
    Route::post('/admin/addParent','Auth\RegisterController@registerParent')->name('addParent');

});
Route::middleware(['auth'])->group(function (){

    Route::get('/parent/assignStudent', 'StudentParentController@getaAssignStudentForm')->name('studentToParentForm');
    Route::post('/parent/assignStudent', 'StudentParentController@assignStudent')->name('studentToParent');

});
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/mail',function (){
    return new App\Mail\TeacherRegistered("adafa","asdfasdaf");
})->name('mail');
