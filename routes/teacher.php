<?php

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Teachers\StudentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Teachers\QuizzeController;
use App\Http\Controllers\Teachers\QuestionController;
use App\Http\Controllers\Teachers\ProfileController;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath','auth:teacher']
    ], function (){

    Route::get('/classes/{id}',[QuizzeController::class,'getClassrooms']);
    Route::get('/Get_Sections/{id}',[QuizzeController::class,'getSections']);

    Route::get('/teacher/dashboard',[HomeController::class,'teacherDashboard'])->name('dashboard');

//    Route::get('/teacher/dashboard/teacher_section',function (){
//
//        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
//        $count_sections = $ids->count();
//        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
//        return view('pages.Teachers.dashboard',compact('count_sections','count_students'));
//    });

    Route::group([
        'prefix' => 'teacher/dashboard',
    ], function ()
    {

        Route::get('students',[StudentController::class,'index'])->name('student.index');

        Route::get('sections',[StudentController::class,'sections'])->name('section.index');

        Route::post('attendance',[StudentController::class,'attendance'])->name('attendance');

        Route::post('edit_attendance',[StudentController::class,'editAttendance'])->name('attendance.edit');

        Route::get('attendance_report',[StudentController::class,'attendanceReport'])->name('attendance_report');

        Route::post('attendance_search',[StudentController::class,'attendanceSearching'])->name('attendance.search');

        Route::resource('quizes',QuizzeController::class);

        Route::resource('tquestions',QuestionController::class);

        Route::get('student_quizze/{id}',[QuizzeController::class,'student_quizze'])->name('student.quizze');

        Route::post('repeat.quizze',[QuizzeController::class,'repeat_quizze'])->name('repeat.quizze');

        Route::get('profile',[ProfileController::class,'getProfileData'])->name('profile.show');
        Route::post('profile/update',[ProfileController::class,'updateData'])->name('profile.update');

    });

});

