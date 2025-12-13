<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
       // $quiz = Quizze::all()->pluck('id');
        $questions = Question::all();
        return view('pages.Teachers.dashboard.questions.index',compact('questions'));
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        try {
            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quizz_id;
            $question->save();

            return  redirect()->back()->with('success',trans('messages.success'));

        }

        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $quizz_id = $id;
        return view('pages.Teachers.dashboard.questions.create',compact('quizz_id'));
    }



    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quizze::all();
        return view('pages.Teachers.dashboard.questions.edit',compact('question','quizzes'));

    }



    public function update(Request $request)
    {
        try {

            $question = Question::findOrFail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quizze_id;
            $question->save();

            return redirect()->back()->with('success',trans('messages.update'));

        }

        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function destroy(Request $request)
    {
        Question::destroy($request->id);

        return redirect()->back()->with('success',trans('messages.delete'));

    }
}
