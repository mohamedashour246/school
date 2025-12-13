<?php

namespace App\Repository;



use App\Models\Grade;
use App\Models\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface

{
     public function index()
     {
         $students = Student::onlyTrashed()->get();
         return view('pages.students.graduated.index',compact('students'));
     }

     public function createGraduation()
     {
         $Grades = Grade::all();
         return view('pages.students.graduated.create',compact('Grades'));
     }

    public function softDelete($request)
     {
        $students = Student::where('grade_id',$request->Grade_id)->where('classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1)
        {
            return redirect()->back()->with('fail','لا توجد بيانات فى جدول الطلاب');
        }

        foreach ($students as $student)
        {
            $ids = explode(',',$student->id);
            Student::whereIn('id',$ids)->Delete();
        }

        return redirect()->route('Graduated.index')->with('success',trans('messages.success'));
     }

     public function returnData($request)
     {
         $students = Student::onlyTrashed()->where('id',$request->id)->first();
         $students->restore();

         return redirect()->back()->with('success',trans('messages.success'));
     }

     public function destroyStudent($request)
     {
         $students = Student::onlyTrashed()->where('id',$request->id)->first();
         $students->forceDelete();

         return redirect()->back()->with('success',trans('messages.delete'));
     }

}
