<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class TeacherRepository implements TeacherRepositoryInterface {

    public function getAllTeachers()
    {
         return  Teacher::all();
    }

    public function getSpecialization()
    {
        return Specialization::all();
    }

    public function getGender()
    {
        return Gender::all();
    }

    public function storeTeacher($request)
    {

         try {

            $validator = Validator::make($request->all(),[

                'email' => 'required|email',
                'Password' => 'required|min:6',
                'Name' => 'required',
                'Specialization_id' => 'required',
                'gender_id' => 'required',
                'joining_Date' => 'required|date',
                'address' => 'required',
            ],
             [
                 'email.required' => 'من فضلك ادخل البريد الالكترونى',
                 'email.email' => 'يجب ادخال بريد الكترونى صالح',
                 'Password.required' => 'من فضلك ادخل كلمة المرور',
                 'Password.min' => 'يجب الا تقل كلمة المرور عن 6 احرف',
                 'Name.required' => 'من فضلك اخل اسم المعلم',
                 'Specialization_id.required' => 'من فضلك ادخل التخصص',
                 'gender_id.required' => 'من فضلك ادخل النوع',
                 'joining_Date.required' => 'من فضلك ادخل ناريخ التعيين',
                 'address.required' => 'من فضلك ادخل العنوان',
             ]);

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $teacher = new Teacher();
            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher->name = $request->Name;
            $teacher->specialization_id = $request->Specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->Joining_Date = $request->joining_Date;
            $teacher->Address = $request->address;
            $teacher->save();

            return redirect()->route('Teachers.create')
                             ->with('success',trans('messages.success'));
         }

         catch(Exception $e)
         {
             return redirect()->back()->with(['error' => $e->getMessage()]);
         }

    }

    public function editTeacher($id)
    {
    //    $Teachers = Teacher::findOrFail($id);
    //    $specializations = Specialization::all();
    //    $genders = Gender::all();

    //    return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
    }

    public function updateTeacher($request)
    {
        try {

           $validator = Validator::make($request->all(),[

               'email' => 'required|email',
               'Name' => 'required',
               'joining_Date' => 'required|date',
               'address' => 'required',
           ],
            [
                'email.required' => 'من فضلك ادخل البريد الالكترونى',
                'email.email' => 'يجب ادخال بريد الكترونى صالح',
                'Name.required' => 'من فضلك اخل اسم المعلم',
                'joining_Date.required' => 'من فضلك ادخل ناريخ التعيين',
                'ddress.required' => 'من فضلك ادخل العنوان',
            ]);

           if($validator->fails())
           {
               return redirect()->back()->withErrors($validator)->withInput();
           }

            $teacher = Teacher::findOrFail($request->id);
            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher->name = $request->Name;
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->Joining_Date = $request->joining_Date;
            $teacher->Address = $request->address;
            $teacher->save();

            if($teacher->save())
            {
                return redirect()->route('Teachers.index')->with('success',trans('messages.update'));
            }
            else {
                return redirect()->back()->with(['error' => 'something went wrong']);
            }

         }

         catch(Exception $e)
         {
             return redirect()->back()->with(['error' => $e->getMessage()]);
         }

    }

    public function deleteTeacher($request)
    {
         $teacher = Teacher::findOrFail($request->id);
         $teacher->delete();

         return redirect()->route('Teachers.index')
                            ->with('success',trans('messages.delete'));
    }
}
