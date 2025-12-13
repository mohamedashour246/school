<?php


namespace App\Repository;


use App\Models\FoundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{
    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view('pages.receipt.index',compact('receipt_students'));
    }

    public function create()
    {

    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            // حفظ البيانات فى جدول سندات القبض
            $receipt_student = new ReceiptStudent();
            $receipt_student->date = date('Y-m-d');
            $receipt_student->student_id = $request->student_id;
            $receipt_student->Debit = $request->Debit;
            $receipt_student->description = $request->description;
            $receipt_student->save();

            // حفظ البيانات فى جدول الصندوق
            $fund_accounts = new FoundAccount();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_student->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // حفظ البيانات فى جدول حساب الطالب
            $fund_account = new StudentAccount();
            $fund_account->date = date('Y-m-d');
            $fund_account->type = 'receipt';
            $fund_account->student_id = $request->student_id;
            $fund_account->receipt_id = $receipt_student->id;
            $fund_account->grade_id = $request->grade_id;
            $fund_account->classroom_id = $request->classroom_id;
            $fund_account->Debit = 0.00;
            $fund_account->Credit = $request->Debit;
            $fund_account->description = $request->description;
            $fund_account->save();

            DB::commit();

            return redirect()->route('receipt_student.index')->with('success',trans('messages.success'));
        }

        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.receipt.add',compact('student'));
    }

    public function edit($id)
    {
        $receipt_student = ReceiptStudent::findOrFail($id);
        return view('pages.receipt.edit',compact('receipt_student'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
            // تعديل البيانات فى جدول سندات القبض
            $receipt_student = ReceiptStudent::findOrFail($request->id);
            $receipt_student->date = date('Y-m-d');
            $receipt_student->student_id = $request->student_id;
            $receipt_student->Debit = $request->Debit;
            $receipt_student->description = $request->description;
            $receipt_student->save();

            // تعديل البيانات فى جدول الصندوق
            $fund_accounts = FoundAccount::where('receipt_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->receipt_id = $receipt_student->id;
            $fund_accounts->Debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();

            // تعديل البيانات فى جدول حساب الطالب
            $fund_account = StudentAccount::where('receipt_id',$request->id)->first();
            $fund_account->date = date('Y-m-d');
            $fund_account->type = 'receipt';
            $fund_account->student_id = $request->student_id;
            $fund_account->receipt_id = $receipt_student->id;
            $fund_account->Debit = 0.00;
            $fund_account->Credit = $request->Debit;
            $fund_account->description = $request->description;
            $fund_account->save();

            DB::commit();

            return redirect()->route('receipt_student.index')->with('success',trans('messages.update'));
        }

        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        $receipt_student = ReceiptStudent::findOrFail($request->id);
        $receipt_student->delete();

        return redirect()->route('receipt_student.index')->with('success',trans('messages.delete'));

    }
}
