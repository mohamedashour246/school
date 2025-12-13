<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Students\ExamController;
use App\Http\Controllers\Students\ProfileController;
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
        'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath','auth:student']
    ], function (){

    Route::get('/student/dashboard',function (){
        return view('pages.students.dashboard');
    });

    Route::group([
        'prefix'  =>  'student/dashboard',

    ],  function () {

        Route::resource('student_exams', ExamController::class);

        Route::resource('profile-students',ProfileController::class);
    });
});

