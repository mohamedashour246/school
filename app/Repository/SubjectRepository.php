<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects = Subject::all();
        return view('pages.subjects.index',compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.subjects.create',compact('grades','teachers'));
    }

    public function store($request)
    {
        try {
            $subject = new Subject();

            $translation = [
                'en' => $request['Name_en'],
                'ar' => $request['Name_ar']
            ];

            $subject->setTranslations('name',$translation);
            $subject->grade_id = $request->Grade_id;
            $subject->classroom_id = $request->Class_id;
            $subject->teacher_id = $request->teacher_id;
            $subject->save();

            return redirect()->route('subjects.index')->with('success',trans('messages.success'));
        }

        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.subjects.edit',compact('subject','grades','teachers'));
    }

    public function update($request)
    {
        try {

            $subject = Subject::findOrFail($request->id);

            $translation = [
                'en' => $request['Name_en'],
                'ar' => $request['Name_ar']
            ];

            $subject->setTranslations('name',$translation);
            $subject->grade_id = $request->Grade_id;
            $subject->classroom_id = $request->Class_id;
            $subject->teacher_id = $request->teacher_id;
            $subject->update();

            return redirect()->route('subjects.index')->with('success',trans('messages.update'));

        }

        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $subject = Subject::findOrFail($request->id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success',trans('messages.delete'));
    }
}
