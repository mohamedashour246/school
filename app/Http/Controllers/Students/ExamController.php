<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $quizzes = Quizze::where('grade_id',auth()->user()->grade_id)
            ->where('classroom_id',auth()->user()->classroom_id)
            ->where('section_id',auth()->user()->section_id)
            ->orderBy('id','DESC')
            ->get();
        //    $quizzes = Quizze::all();

        return view('pages.students.dashboard.exams.index',compact('quizzes'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($quizze_id)
    {
       // $quizze_id = Quizze::findOrfail($id);
        $student_id = Auth::user()->id;
        return view('pages.students.dashboard.exams.show',compact('student_id','quizze_id'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
