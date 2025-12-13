<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
     public function index()
     {
         $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
         $students = Student::whereIn('section_id',$ids)->get();
         return view('pages.Teachers.dashboard.students.index',compact('students'));
     }

     public function sections()
     {
         $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
         $sections = Section::whereIn('id',$ids)->get();
         return view('pages.Teachers.dashboard.sections.index',compact('sections'));

     }

     public function attendance(Request $request)
     {
         try {

             $attenddate = date('Y-m-d');
        //     $classid = $request->section_id;
             foreach ($request->attendences as $studentid => $attendence) {

                 if ($attendence == 'presence') {
                     $attendance_status = true;
                 } else if ($attendence == 'absent') {
                     $attendance_status = false;
                 }

                 Attendance::updateorCreate([
                     'student_id'=>  $studentid,
                     'attendance_date'  =>  $attenddate
                 ],
                     [
                         'student_id' => $studentid,
                         'grade_id' => $request->grade_id,
                         'classroom_id' => $request->classroom_id,
                         'section_id' => $request->section_id,
                         'teacher_id' => auth()->user()->id,
                         'attendance_date' => $attenddate,
                         'attendance_status' => $attendance_status
                     ]);
             }
             return redirect()->back()->with('success',trans('messages.success'));
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
     }

     public function editAttendance(Request $request)
     {
         try {
             $date = date('Y-m-d');
             $student_id  = Attendance::where('attendance_date',$date)->where('student_id',$request->id)->first();

             if( $request->attendences == 'presence' ) {
                 $attendence_status = true;
             } else if( $request->attendences == 'absent' ){
                 $attendence_status = false;
             }

             $student_id->update([
                  'attendance_status' => $attendence_status
             ]);

             return redirect()->back()->with('success',trans('messages.update'));
         }

         catch (\Exception $e){
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
     }

     public function attendanceReport(Request $request)
     {
         $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
         $students = Student::whereIn('section_id',$ids)->get();
         return view('pages.Teachers.dashboard.students.attendance_report',compact('students'));
     }

     public function attendanceSearching(Request $request)
     {
        $this->validate($request,[
             'from'  =>  'required|date|date_format:Y-m-d',
             'to'  =>  'required|date|date_format:Y-m-d|after_or-equal:from',
         ],
         [

             'from..date_format'  =>  'صيفة التاريخ يجب ان تكون yyyy-mm-dd',
             'to.date_format'  =>  'صيفة التاريخ يجب ان تكون yyyy-mm-dd',
             'to.after_or-equal'  => 'تاريخ النهاية لا بد ان يكون اكبر من تاريخ البداية او يساويه',
         ]);


         $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
         $students = Student::whereIn('section_id',$ids)->get();

         if($request->student_id == 0)
         {
             $Students = Attendance::with('students')->whereBetween('attendance_date',[$request->from,$request->to])->get();
             return view('pages.Teachers.dashboard.students.attendance_report',compact('students','Students'));
         }

         else {

             $Students = Attendance::with('students')->whereBetween('attendance_date',[$request->from,$request->to])
                 ->where('student_id',$request->student_id)
                 ->get();
             return view('pages.Teachers.dashboard.students.attendance_report',compact('students','Students'));
         }
     }
}
