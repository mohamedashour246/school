<?php

namespace App\Repository;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\ClassRoom;
use App\Models\Gender;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Exception;

class StudentRepository implements StudentRepositoryInterface
{
    use AttachFilesTrait;

    public function createStudent()
    {
        $data['my_classes'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = TypeBlood::all();

        return view('pages.students.create',$data);
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

    public function storeStudent($request)
    {
        DB::beginTransaction();
        try {

            $student = new Student();
            $student->name = ['en' => $request->name_en , 'ar' => $request->name_ar];
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->gender_id = $request->gender_id;
            $student->nationality_id = $request->nationalitie_id;
            $student->blood_id = $request->blood_id;
            $student->Date_Birth = $request->Date_Birth;
            $student->grade_id = $request->Grade_id;
            $student->classroom_id = $request->Classroom_id;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            $student->save();

            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$student->name,$file->getClientOriginalName(),'upload_attachments');

                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $student->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit();
            return redirect()->route('students.index')->with('success',trans('messages.success'));

        }

        catch (Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function editStudent($id)
    {
        $data['my_classes'] = ClassRoom::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['Grades'] = Grade::all();
        $data['nationals'] = Nationalitie::all();
        $data['bloods'] = TypeBlood::all();

        $Students = Student::findOrFail($id);
        return view('pages.students.edit',$data,compact('Students'));
    }

    public function updateStudent($request)
    {
        $validator = Validator::make($request->all(), [

            'name_ar' =>'required',
            'name_en' =>'required',
            'email' =>'required|email',
            'gender_id' =>'required',
            'blood_id' =>'required',
            'Date_Birth' =>'required',
            'Grade_id' =>'required',
            'Classroom_id' =>'required',
            'section_id' =>'required',
            'parent_id' =>'required',
            'academic_year' =>'required',
        ],
            [
                'name_ar.required' => 'من فضلك ادخل اسم الطالب باللغة العربية',
                'name_en.required' => 'من فضلك ادخل اسم الطالب باللغة الانجليزية',
                'email.required' => 'من فضلك ادخل البريد الالكترونى',
                'email.email' => 'يجب ادخال بريد الكترونى صالح',
                'gender_id.required' => 'من فضلك ادخل النوع',
                'blood_id.required' => 'من فضلك ادخل فصيلة الدم',
                'Date_Birth.required' => 'من فضلك ادخل تاريخ الميلاد',
                'Grade_id.required' => 'من فضلك ادخل المرحلة الدراسية',
                'Classroom_id.required' => 'من فضلك ادخل الصف الدراسى',
                'section_id.required' => 'من فضلك ادخل القسم',
                'parent_id.required' => 'من فضلك ادخل ولى الامر',
                'academic_year.required' => 'من فضلك ادخل السنة الدراسية',
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $Students = Student::findOrFail($request->id);
        $Students->name = ['en' => $request->name_en , 'ar' => $request->name_ar];
        $Students->email = $request->email;
        $Students->password = Hash::make($request->password);
        $Students->gender_id = $request->gender_id;
        $Students->nationality_id = $request->nationalitie_id;
        $Students->blood_id = $request->blood_id;
        $Students->Date_Birth = $request->Date_Birth;
        $Students->grade_id = $request->Grade_id;
        $Students->classroom_id = $request->Classroom_id;
        $Students->section_id = $request->section_id;
        $Students->parent_id = $request->parent_id;
        $Students->academic_year = $request->academic_year;
        $Students->update();

        return redirect()->route('students.index')->with('success',trans('messages.update'));

    }

    public function deleteStudent($request)
    {
         $student = Student::findOrFail($request->id);

         $this->deleteFile($student->name,'students');

        $student->forceDelete();


        return redirect()->route('students.index')->with('success',trans('messages.delete'));
    }

    public function showStudent($id)
    {
        $Student = Student::findOrFail($id);

        return view('pages.students.show',compact('Student'));
    }

    public function uploadAttachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->student_name,$file->getClientOriginalName(),'upload_attachments');

            $images = new Image();
            $images->filename = $name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }

        return redirect()->route('students.show',$request->student_id)->with('success',trans('messages.success'));
    }

    public function downloadAttachment($student_name,$filename)
    {
     // return response()->download(public_path('attachments/students/'.$student_name.'/'.$filename));
//        return Storage::download(public_path('attachments/students/'.$student_name.'/'.$filename));
       $file = public_path('attachments/students/'.$student_name.'/'.$filename);
       return response()->download($file);
    }

    public function deleteAttachment($request)
    {
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        Image::where('id',$request->id)->where('filename',$request->filename)->delete();

        return redirect()->back()->with('success',trans('messages.delete'));

    }
}
