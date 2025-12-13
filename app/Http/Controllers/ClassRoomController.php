<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{

    public function index()
    {
        $My_Classes = ClassRoom::all();
        $Grades = Grade::all();
        return view('pages.myClasses.myClasses',compact('My_Classes','Grades'));

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'List_Classes.*.Name' => 'required',
            'List_Classes.*.Name_class_en' => 'required',
            'List_Classes.*.Grade_id' => 'required'
        ],
        [
          'List_Classes.*.Name.required' =>
                'من فضلك قم بادخال اسم الصف بالعربى',
          'List_Classes.*.Name_class_en.required' =>
                'من فضلك قم بادخال اسم الصف بالانجليزى',
          'Grade_id.required' => 'من فضلك قم بادخال اسم المرحلة'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        $list_Classes = $request['List_Classes'];

        foreach($list_Classes as $list_Class)
        {
            $my_Classes = new ClassRoom();
            $my_Classes->name_class = [
                'en' => $list_Class['Name_class_en'],
                'ar' => $list_Class['Name']
            ];

            $my_Classes->grade_id = $list_Class['Grade_id'];

            $my_Classes->save();
        }

        return redirect()->back()->with('success',trans('messages.success'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'Name' => 'required',
            'Name_class_en' => 'required',
            'Grade_id' => 'required'
        ],
        [
          'Name.required' =>
                'من فضلك قم بادخال اسم الصف بالعربى',
          'Name_class_en.required' =>
                'من فضلك قم بادخال اسم الصف بالانجليزى',
          'Grade_id.required' => 'من فضلك قم بادخال اسم المرحلة'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->with('errors',$validator->errors());
        }

        $classrooms = ClassRoom::findOrFail($request['id']);

        $translation = [
            'en' => $request['Name_en'],
            'ar' => $request['Name']
     ];

     $classrooms->setTranslations('name_class',$translation);
     $classrooms->grade_id = $request['Grade_id'];
     $classrooms->update();

     return redirect()->back()->with('success',trans('messages.update'));

    }


    public function destroy(Request $request)
    {
        $classrooms = ClassRoom::findOrFail($request['id']);
        $classrooms->delete();

        return redirect()->back()->with('success',trans('messages.delete'));
    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);
//        dd($delete_all_id);

        ClassRoom::whereIn('id',$delete_all_id)->Delete();

        return redirect()->back()->with('success',trans('messages.delete'));
    }

    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $search = ClassRoom::select('*')->where('grade_id',$request->Grade_id)->get();
        return view('pages.myClasses.myClasses',compact('Grades'))->withDetails($search);
    }
}
