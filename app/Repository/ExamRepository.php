<?php


namespace App\Repository;


use App\Models\Exam;

class ExamRepository implements ExamRepositoryInterface
{

    public function index()
    {
        $exams = Exam::all();
        return view('pages.exams.index',compact('exams'));
    }

    public function create()
    {
         return view('pages.exams.create');
    }

    public function store($request)
    {
        try {
             $exam = new Exam();

            $translation = [
                'en' => $request['Name_en'],
                'ar' => $request['Name_ar']
            ];

            $exam->setTranslations('name',$translation);
            $exam->term = $request->term;
            $exam->academic_year = $request->academic_year;
            $exam->save();

            return redirect()->route('exams.index')->with('success',trans('messages.success'));


        }

        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        return view('pages.exams.edit',compact('exam'));
    }

    public function update($request)
    {

        try {
            $exam = Exam::findOrFail($request->id);

            $translation = [
                'en' => $request['Name_en'],
                'ar' => $request['Name_ar']
            ];

            $exam->setTranslations('name',$translation);
            $exam->term = $request->term;
            $exam->academic_year = $request->academic_year;
            $exam->save();

            return redirect()->route('exams.index')->with('success',trans('messages.update'));


        }

        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $exam = Exam::findOrFail($request->id);
        $exam->delete();

        return redirect()->route('exams.index')->with('success',trans('messages.delete'));

    }
}
