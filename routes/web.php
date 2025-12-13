<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\FeesInvoicesController;
use App\Http\Controllers\ReceiptStudentController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\OnlineClassController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\SettingController;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();

    Route::get('register',[RegisterController::class,'register'])->name('register');

    Route::post('/post/register',[RegisterController::class,'postRegister'])->name('register.post');

    Route::get('/',[HomeController::class,'index'])->name('selection');

    Route::get('login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');

    Route::post('login',[LoginController::class,'postLogin'])->name('login');

    Route::get('/logout/{type}',[LoginController::class,'logout'])->name('logout');

// 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'user' ]

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['user','localeSessionRedirect','localizationRedirect','localeViewPath']
    ], function (){

    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');

    Route::resource('Grades',GradeController::class);
    Route::resource('Classrooms',ClassRoomController::class);
    Route::post('delete_all',[ClassRoomController::class,'delete_all'])->name('delete_all');
    Route::post('Filter_Classes',[ClassRoomController::class,'Filter_Classes'])->name('Filter_Classes');
    Route::resource('sections',SectionController::class);
    Route::get('/classes/{id}',[SectionController::class,'getClasses']);

    Route::view('add_parent','livewire.show_form')->name('add_parent');

    Route::resource('Teachers',TeacherController::class);

    Route::resource('students',StudentController::class);

    Route::group([],function () {

        Route::get('/Get_classrooms/{id}',[StudentController::class,'getClassrooms']);
        Route::get('/Get_tSections/{id}',[StudentController::class,'getSections']);

        Route::post('Upload_attachment',[StudentController::class,'uploadAttachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{student_name}/{filename}',[StudentController::class,'downloadAttachment'])->name('Download_attachment');
        Route::post('Delete_attachment',[StudentController::class,'deleteAttachment'])->name('Delete_attachment');

        Route::resource('promotions',PromotionController::class);

        Route::resource('Graduated',GraduatedController::class);

        Route::resource('fees',FeesController::class);

        Route::resource('FeesInvoices',FeesInvoicesController::class);

        Route::resource('receipt_student',ReceiptStudentController::class);

        Route::resource('processingFee',ProcessingFeeController::class);

        Route::resource('Payment_students',PaymentController::class);

        Route::resource('attendance',AttendanceController::class);

        Route::resource('subjects',SubjectController::class);

        Route::resource('exams',ExamController::class);

        Route::resource('Quizzes',QuizController::class);

        Route::resource('questions',QuestionController::class);

        Route::resource('online_classes',OnlineClassController::class);

        Route::get('indirect',[OnlineClassController::class,'indirectCreate'])->name('indirect.create');

        Route::post('indirect/post',[OnlineClassController::class,'storeIndirect'])->name('indirect.post');

        Route::resource('libraries',LibraryController::class);

        Route::get('download_file/{filename}',[LibraryController::class,'downloadAttachment'])->name('downloadAttachment');

        Route::get('settings',[SettingController::class,'index'])->name('settings');

        Route::post('settings/update',[SettingController::class,'update'])->name('settings.update');
    });

//    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

    Route::get('test', function(){

        return view('test');
    });

