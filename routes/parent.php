<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Parents\ChildrenController;
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
        'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath','auth:parent']
    ], function (){

    Route::get('/parent/dashboard',function (){
        return view('pages.parents.dashboard');
    });

    Route::group([
        'prefix'  =>  'parent/dashboard',
//        'namespace'  => 'Parents'

    ],  function () {

        Route::resource('sons',ChildrenController::class);

        Route::get('results/{id}',[ChildrenController::class,'results'])->name('sons.results');

        Route::get('attendances',[ChildrenController::class,'attendances'])->name('sons.attendances');

       // Route::get('attendances',[ChildrenController::class,'attendances'])->name('sons.attendances');

        Route::post('attendances/search',[ChildrenController::class,'attendanceSearching'])->name('attendances.Search');

        Route::get('fees',[ChildrenController::class,'fees'])->name('sons.fees');

        Route::get('receipt/{id}',[ChildrenController::class,'receiptStudent'])->name('sons.receipt');

        Route::get('profile',[ChildrenController::class,'profile'])->name('profile.parent.show');
        Route::post('profile/update/{id}',[ChildrenController::class,'updateData'])->name('profile.parent.update');

    });
});
