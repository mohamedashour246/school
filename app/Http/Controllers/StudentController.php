<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    protected $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
         $this->Student = $Student;
    }

    public function index()
    {
        $students = Student::all();

        return view('pages.students.index',compact('students'));
    }

    public function create()
    {
        return $this->Student->createStudent();
    }

    public function store(StoreStudentRequest $request)
    {
        return $this->Student->storeStudent($request);
    }

    public function show($id)
    {
        return $this->Student->showStudent($id);
    }

    public function edit($id)
    {
        return $this->Student->editStudent($id);
    }

    public function update(Request $request)
    {
        return $this->Student->updateStudent($request);
    }

    public function destroy(Request $request)
    {
        return $this->Student->deleteStudent($request);
    }

    public function getClassrooms($id)
    {
        return $this->Student->getClassrooms($id);
    }

    public function getSections($id)
    {
        return $this->Student->getSections($id);
    }

    public function uploadAttachment(Request $request)
    {
        return $this->Student->uploadAttachment($request);
    }

    public function downloadAttachment($student_name,$filename)
    {
        return $this->Student->downloadAttachment($student_name,$filename);
    }

    public function deleteAttachment(Request $request)
    {
        return $this->Student->deleteAttachment($request);
    }
}
