<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\ClassRoom;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;

class QuizzRepository implements QuizzRepositoryInterface
{

    public function index()
    {
        $quizzes = Quizze::all();
        return view('pages.quizzes.index',compact('quizzes'));
    }

    public function create()
    {
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        $data['grades'] = Grade::all();

        return view('pages.quizzes.create',$data);
    }

    public function store($request)
    {
        try {

            $quiz = new Quizze();
            $quiz-> name = [
                'en' => $request->Name_en,
                'ar' => $request->Name_ar
            ];
            $quiz->subject_id = $request->subject_id;
            $quiz->grade_id = $request->Grade_id;
            $quiz->classroom_id = $request->Class_id;
            $quiz->section_id = $request->section_id;
            $quiz->teacher_id = $request->teacher_id;
            $quiz->save();

            return redirect()->route('Quizzes.index')->with('success',trans('messages.success'));

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
        $quizz = Quizze::findOrFail($id);
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        $data['grades'] = Grade::all();
        $data['classes'] = ClassRoom::all();

        return view('pages.quizzes.edit',$data,compact('quizz'));
    }

    public function update($request)
    {
         try {
             $quizz = Quizze::findOrFail($request->id);

             $quizz-> name = [
                 'en' => $request->Name_en,
                 'ar' => $request->Name_ar
             ];
             $quizz->subject_id = $request->subject_id;
             $quizz->grade_id = $request->Grade_id;
             $quizz->classroom_id = $request->Class_id;
             $quizz->section_id = $request->section_id;
             $quizz->teacher_id = $request->teacher_id;
             $quizz->save();

             return redirect()->route('Quizzes.index')->with('success',trans('messages.update'));

         }
         catch (\Exception $e)
         {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function destroy($request)
    {
         $quizz = Quizze::findOrFail($request->id);
         $quizz->delete();

        return redirect()->route('Quizzes.index')->with('success',trans('messages.delete'));

    }
}
