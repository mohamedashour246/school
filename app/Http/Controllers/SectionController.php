<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\ClassRoom;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();

        $list_Grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.sections.sections', compact('Grades','list_Grades','teachers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(Section::where('name->ar',$request['Name_Section_Ar'])->
                 orWhere('name->en',$request['Name_Section_En'])->exists())
        {
            return redirect()->back()->with('fail',trans('main_trans.exists'));
        }

        $validator = Validator::make($request->all(),[
            'Name_Section_Ar' => 'required',
            'Name_Section_En' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
        ],
        [
          'Name_Section_Ar.required' => 'من فضلك قم بادخال اسم القسم بالعربى',
          'Name_Section_En.required' => 'من فضلك قم بادخال اسم القسم بالانجليزية',
          'Grade_id.required' => 'من فضلك قم بادخال المرحلة',
          'Class_id.required' => 'من فضلك قم بادخال الصف',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        $section = new Section();

        $translation = [
            'en' => $request['Name_Section_En'],
            'ar' => $request['Name_Section_Ar']
        ];

        $section->setTranslations('name',$translation);
        $section->grade_id = $request['Grade_id'];
        $section->class_id = $request['Class_id'];
        $section->status = 1;
        $section->save();
        $section->teachers()->attach($request->teacher_id);

        return redirect()->back()->with('success',trans('messages.success'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'Name_Section_Ar' => 'required',
            'Name_Section_En' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
        ],
        [
          'Name_Section_Ar.required' => 'من فضلك قم بادخال اسم القسم بالعربى',
          'Name_Section_En.required' => 'من فضلك قم بادخال اسم القسم بالانجليزية',
          'Grade_id.required' => 'من فضلك قم بادخال المرحلة',
          'Class_id.required' => 'من فضلك قم بادخال الصف',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        $section = Section::findOrFail($request->id);
        $section->name = ['ar' => $request['Name_Section_Ar'] , 'en' => $request['Name_Section_En']];
        $section->grade_id = $request['Grade_id'];
        $section->class_id = $request['Class_id'];

        if(isset($request['Status']))
        {
            $section->status = 1;
        }
        else {
            $section->status = 2;
        }

        if(isset($request->teacher_id))
        {
            $section->teachers()->sync($request->teacher_id);
        }
        else
        {
            $section->teachers()->sync(array());
        }

        $section->update();
        return redirect()->back()->with('success',trans('messages.update'));
    }

    public function destroy(Request $request)
    {
        $section = Section::findOrFail($request['id']);

        $section->delete();
        return redirect()->back()->with('success',trans('messages.delete'));
    }

    public function getClasses($id)
    {
        $list_classes = ClassRoom::where('grade_id',$id)->pluck('name_class','id');

        return $list_classes;
    }
}
