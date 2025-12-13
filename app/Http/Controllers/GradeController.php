<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Grades.Grades',compact('Grades'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(Grade::where('name->ar',$request['Name'])->
                  orWhere('name->en',$request['Name_en'])->exists())
        {
           return redirect()->back()->with('fail',trans('Grade_trans.exists'));
        }

        $validator = Validator::make($request->all(),[
            'Name' => 'required',
            'Name_en' => 'required',
            'Notes' => 'required'
        ],
        [
          'Name.required' => 'من فضلك قم بادخال اسم المرحلة بالعربى',
          'Name_en.required' => 'من فضلك قم بادخال اسم المرحلة بالانجليزية',
          'Notes.required' => 'من فضلك قم بادخال الملاحظات'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        $grade = new Grade();

        $translation = [
               'en' => $request['Name_en'],
               'ar' => $request['Name']
        ];

        $grade->setTranslations('name',$translation);
        $grade->notes = $request['Notes'];
        $grade->save();

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
            'Name' => 'required',
            'Name_en' => 'required',
            'Notes' => 'required'
        ],
        [
          'Name.required' => 'من فضلك قم بادخال اسم المرحلة بالعربى',
          'Name_en.required' => 'من فضلك قم بادخال اسم المرحلة بالانجليزية',
          'Notes.required' => 'من فضلك قم بادخال الملاحظات'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        $grade = Grade::findOrFail($request->id);

        $translation = [
               'en' => $request['Name_en'],
               'ar' => $request['Name']
        ];

        $grade->setTranslations('name',$translation);

        $grade->notes = $request['Notes'];
        $grade->update();

        return redirect()->back()->with('success',trans('messages.update'));
    }

    public function destroy(Request $request)
    {

        $myClass_id = ClassRoom::where('grade_id',$request->id)->pluck('grade_id');

        if($myClass_id->count() == 0)
        {
            $grade = Grade::find($request['id']);

            $grade->delete();
            return redirect()->back()->with('success',trans('messages.delete'));
        }

        else {
            return redirect()->back()->with('fail',trans('Grade_trans.delete_Grade_Error'));
        }

    }
}
