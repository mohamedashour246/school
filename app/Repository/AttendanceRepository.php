<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index()
    {
        $Grades = Grade::with(['sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.attendance.sections',compact('Grades','list_Grades','teachers'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.attendance.index',compact('students'));
    }

    public function store($request)
    {
        try {

             foreach ($request->attendences as $student_id => $attendance)
             {
                 if($attendance == 'presence')
                 {
                     $attendance_status = true;
                 }
                 elseif ($attendance == 'absent')
                 {
                     $attendance_status = false;
                 }

                 Attendance::create([
                      'student_id' => $student_id,
                      'grade_id' => $request->grade_id,
                      'classroom_id' => $request->classroom_id,
                      'section_id' => $request->section_id,
                      'teacher_id' => 1,
                      'attendance_date' => date('Y-m-d'),
                      'attendance_status' => $attendance_status,
                 ]);
             }

             return redirect()->route('attendance.index')->with('success',trans('messages.success'));
        }

        catch(\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {

    }

    public function update($request)
    {

    }

    public function destroy($request)
    {

    }


}
