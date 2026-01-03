<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fee_invoice;
use App\Models\MyParent;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{

    public function index()
    {
        $students = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.childrens.index',compact('students'));
    }

    public function results($id)
    {
        $student = Student::findOrFail($id);

        if($student->parent_id !== auth()->user()->id)
        {
            return redirect()->back()->with('error','حدث خطأ ما');
        }
        $degrees = Degree::where('student_id',$id)->get();

        if($degrees->isEmpty())
        {
             return redirect()->back()->with('error','لا توجد نتائج لهذا الطالب ');
        }

        return view('pages.parents.degrees.index',compact('degrees'));
    }

    public function attendances()
    {
        $students = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.attendance.index',compact('students'));
    }

    public function  attendanceSearching(Request $request)
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
            return view('pages.parents.attendance.index',compact('Students','students'));
        }

        else {

            $Students = Attendance::with('students')->whereBetween('attendance_date',[$request->from,$request->to])
                ->where('student_id',$request->student_id)
                ->get();
            return view('pages.parents.attendance.index',compact('Students','students'));
        }
    }

    public function fees()
    {
        $student_ids = Student::where('parent_id',auth()->user()->id)->pluck('id');
        $Fee_invoices = Fee_invoice::whereIn('student_id',$student_ids)->get();
        return view('pages.parents.fees.index',compact('Fee_invoices'));
    }

    public function receiptStudent($id)
    {
        $student = Student::findOrFail($id);
        if($student->parent_id != auth()->user()->id){
            return redirect()->back()->with('error','حدث خطأ ما');
        }

        $receipt_students = ReceiptStudent::where('student_id',$id)->get();

        if($receipt_students->isEmpty()) {
            return redirect()->back()->with('success','لا توجد مدفوعات لهذا الطالب');
        }

        return view('pages.parents.receipt.index',compact('receipt_students'));
    }

    public function profile()
    {
        $information  = MyParent::findOrfail(auth()->user()->id);
        return view('pages.parents.profile',compact('information'));
    }

    public function updateData(Request $request, $id)
    {
        $information = MyParent::findOrFail($id);

        if(!empty($request->password))
        {
            $information->name_father = [ 'ar' => $request->name_father_ar,
                'en' => $request->name_father_en ];
            $information->password = bcrypt($request->password);
            $information->save();
        }

        else {
            $information->name_father = [ 'ar' => $request->name_father_ar,
                'en' => $request->name_father_en ];
            $information->save();
        }

        return redirect()->back()->with('success',trans('messages.update'));
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
        //
    }

    public function destroy($id)
    {
        //
    }
}
