<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    public function index()
    {
        // dd($this->Teacher->getAllTeachers());

        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.Teachers.teachers',compact('Teachers'));
    }


    public function create()
    {
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGender();

        return view('pages.Teachers.create',compact('specializations','genders'));
    }

    public function store(Request $request)
    {
        return $this->Teacher->storeTeacher($request);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Teachers = Teacher::findOrFail($id);
        $specializations = $this->Teacher->getSpecialization();
        $genders = $this->Teacher->getGender();

        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));

     //   return $this->Teacher->editTeacher($request);
    }

    public function update(Request $request)
    {
        return $this->Teacher->updateTeacher($request);
    }

    public function destroy(Request $request)
    {
        return $this->Teacher->deleteTeacher($request);
    }
}
