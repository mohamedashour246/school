<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $information  = Student::findOrfail(auth()->user()->id);
        return view('pages.students.dashboard.profile',compact('information'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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
        $information = Student::findOrFail($id);

        if(!empty($request->password))
        {
            $information->name = [ 'ar' => $request->Name_ar,
                                   'en' => $request->Name_en ];
            $information->password = Hash::make($request->password);
            $information->save();
        }

        else {
            $information->name = [ 'ar' => $request->Name_ar,
                                   'en' => $request->Name_en ];
            $information->save();
        }

        return redirect()->back()->with('success',trans('messages.update'));
    }


    public function destroy($id)
    {
        //
    }
}
