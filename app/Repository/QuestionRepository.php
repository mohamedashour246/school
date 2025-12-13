<?php


namespace App\Repository;


use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Support\Facades\Validator;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {
        $questions = Question::all();

        return view('pages.questions.index',compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizze::all();

        return view('pages.questions.create',compact('quizzes'));
    }

    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [

                'title' => 'required',
                'answers' => 'required',
                'right_answer' => 'required',
                'quizze_id' => 'required',
                'score' => 'required',
            ],
                [
                    'title.required' => 'من فضلك اخل اسم السؤال',
                    'answers.required' => 'من فضلك ادخل الاجابات',
                    'right_answer.required' => 'من فضلك ادخل الاجابة الصحيحة',
                    'quizze_id.required' => 'من فضلك ادخل اسم الاختبار',
                    'score.required' => 'من فضلك ادخل الدرجة',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $question = new Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quizze_id;
            $question->save();

            return redirect()->route('questions.index')->with('success',trans('messages.success'));

        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $quizzes = Quizze::all();
        $question = Question::findOrFail($id);

        return view('pages.questions.edit',compact('question','quizzes'));
    }

    public function update($request)
    {
        try {
            $validator = Validator::make($request->all(), [

                'title' => 'required',
                'answers' => 'required',
                'right_answer' => 'required',
                'quizze_id' => 'required',
                'score' => 'required',
            ],
                [
                    'title.required' => 'من فضلك اخل اسم السؤال',
                    'answers.required' => 'من فضلك ادخل الاجابات',
                    'right_answer.required' => 'من فضلك ادخل الاجابة الصحيحة',
                    'quizze_id.required' => 'من فضلك ادخل اسم الاختبار',
                    'score.required' => 'من فضلك ادخل الدرجة',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $question = Question::findOrFail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quiz_id = $request->quizze_id;
            $question->save();

            return redirect()->route('questions.index')->with('success',trans('messages.update'));

        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $question = Question::findOrFail($request->id);
        $question->delete();

        return redirect()->route('questions.index')->with('success',trans('messages.delete'));
    }
}
