<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{

    public function index()
    {
        $quizzes =  Quizze::where('teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.quizzes.index',compact('quizzes'));

    }

    public function create()
    {
        $data['subjects'] =  Subject::where('teacher_id',auth()->user()->id)->get();
        $data['grades'] =  Grade::all();

        return view('pages.Teachers.dashboard.quizzes.create',$data);

    }

    public function store(Request $request)
    {
        try  {
            $quiz  = new Quizze();

            $quiz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quiz->subject_id = $request->subject_id;
            $quiz->grade_id = $request->Grade_id;
            $quiz->classroom_id = $request->Class_id;
            $quiz->section_id = $request->section_id;
            $quiz->teacher_id = auth()->user()->id;
            $quiz->save();

            return redirect()->back()->with('success',trans('messages.success'));
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $questions  =  Question::where('quiz_id',$id)->get();
        $quizz = Quizze::findOrFail($id);
        return view('pages.Teachers.dashboard.questions.index',compact('questions','quizz'));
    }

    public function edit($id)
    {
        $quizz = Quizze::findOrFail($id);
        $data['subjects'] = Subject::where('teacher_id',auth()->user()->id)->get();
        $data['grades'] = Grade::all();

        return view('pages.Teachers.dashboard.quizzes.edit',$data,compact('quizz'));
    }

    public function update(Request $request)
    {
        try  {
            $quizz  = Quizze::findOrFail($request->id);

            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->save();

            return redirect()->route('quizes.index')->with('success',trans('messages.update'));
        }

        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy(Request $request)
    {
        try {

            Quizze::destroy($request->id);

            return redirect()->route('quizes.index')->with('success',trans('messages.delete'));

        }

        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getClassrooms($id)
    {
        $list_classes = ClassRoom::where('grade_id',$id)->pluck('name_class','id');
        return $list_classes;
    }

    public function getSections($id)
    {
        $list_sections = Section::where('class_id',$id)->pluck('name','id');
        return $list_sections;
    }

    public function student_quizze($quizze_id)
    {
        $degrees = Degree::where('quiz_id',$quizze_id)->get();
        return view('pages.Teachers.dashboard.quizzes.student_quizze',compact('degrees'));
    }

    public function repeat_quizze(Request $request)
    {
        Degree::where('student_id',$request->student_id)->where('quiz_id',$request->quizze_id)->delete();

        return redirect()->back()->with('success','تم فتح الاختبار مرةاخرى للطالب');
    }
}
