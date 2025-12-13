<?php


namespace App\Repository;


use App\Models\FoundAccount;
use App\Models\PaymentStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
     public function index()
     {
        $payment_students = PaymentStudent::all();
        return view('pages.payment.index',compact('payment_students'));
     }

     public function show($id)
     {
         $student = student::findOrFail($id);
         return view('pages.payment.add',compact('student'));
     }

     public function edit($id)
     {
         $payment_student = PaymentStudent::findOrFail($id);
         return view('pages.payment.edit',compact('payment_student'));
     }

    public function store($request)
     {
         DB::beginTransaction();

         try {
             // حفظ البيانات فى جدول سندات الصرف
             $payment_students = new PaymentStudent();
             $payment_students->date = date('Y-m-d');
             $payment_students->student_id = $request->student_id;
             $payment_students->amount = $request->Debit;
             $payment_students->description = $request->description;
             $payment_students->save();

             // حفظ البيانات فى جدول الصندوق
             $fund_account = new FoundAccount();
             $fund_account->date = date('Y-m-d');
             $fund_account->payment_id = $payment_students->id;
             $fund_account->Debit = 0.00;
             $fund_account->Credit = $request->Debit;
             $fund_account->description = $request->description;
             $fund_account->save();


             // حفظ البيانات فى جدول حساب الطالب
             $student_account = new StudentAccount();
             $student_account->date = date('Y-m-d');
             $student_account->type = 'payment';
             $student_account->student_id = $request->student_id;
             $student_account->payment_id  = $payment_students->id;
             $student_account->grade_id = $request->grade_id;
             $student_account->classroom_id = $request->classroom_id;
             $student_account->Debit = $request->Debit;
             $student_account->Credit = 0.00;
             $student_account->description = $request->description;
             $student_account->save();

             DB::commit();

             return redirect()->route('Payment_students.index')->with('success',trans('messages.success'));
         }

         catch (\Exception $e)
         {
             DB::rollBack();
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
     }

     public function update($request)
     {
         DB::beginTransaction();

         try {
             // تعديل البيانات فى جدول سندات الصرف
             $payment_students = PaymentStudent::findOrFail($request->id);
             $payment_students->date = date('Y-m-d');
             $payment_students->student_id = $request->student_id;
             $payment_students->amount = $request->Debit;
             $payment_students->description = $request->description;
             $payment_students->save();

             // تعديل البيانات فى جدول الصندوق
             $fund_account = FoundAccount::where('payment_id',$request->id)->first();
             $fund_account->date = date('Y-m-d');
             $fund_account->payment_id = $payment_students->id;
             $fund_account->Debit = 0.00;
             $fund_account->Credit = $request->Debit;
             $fund_account->description = $request->description;
             $fund_account->save();


             // تعديل البيانات فى جدول حساب الطالب
             $student_account = StudentAccount::where('payment_id',$request->id)->first();
             $student_account->date = date('Y-m-d');
             $student_account->type = 'payment';
             $student_account->student_id = $request->student_id;
             $student_account->payment_id  = $payment_students->id;
             $student_account->Debit = $request->Debit;
             $student_account->Credit = 0.00;
             $student_account->description = $request->description;
             $student_account->save();

             DB::commit();

             return redirect()->route('Payment_students.index')->with('success',trans('messages.update'));
         }

         catch (\Exception $e)
         {
             DB::rollBack();
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }

     }

     public function destroy($request)
     {
         $payment_student = PaymentStudent::findOrFail($request->id);
         $payment_student->delete();

         return redirect()->route('Payment_students.index')->with('success',trans('messages.delete'));

     }
}
