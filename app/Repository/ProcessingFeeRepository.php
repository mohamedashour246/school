<?php


namespace App\Repository;


use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{  // fee_invoice
   // paymentstudent
    // processingFee
    // receiptstudent
    // studentAccount
    // found account

    public function index()
    {
        $ProcessingFees = ProcessingFee::all();
        return view('pages.processing_fee.index',compact('ProcessingFees'));

    }

    public function create()
    {

    }

    public function store($request)
    {
         DB::beginTransaction();

         try {

             // حفظ البيانات فى جدول معالجة الرسوم
             $processingFee = new ProcessingFee();
             $processingFee->date = date('Y-m-d');
             $processingFee->student_id =$request->student_id;
             $processingFee->amount = $request->Debit;
             $processingFee->description = $request->description;
             $processingFee->save();

             // حفظ البيانات فى جدول حساب الطالب
             $student_account = new StudentAccount();
             $student_account->date = date('Y-m-d');
             $student_account->type = 'processingFee';
             $student_account->student_id = $request->student_id;
             $student_account->processingfee_id = $processingFee->id;
             $student_account->grade_id = $request->grade_id;
             $student_account->classroom_id = $request->classroom_id;
             $student_account->Debit = 0.00;
             $student_account->Credit = $request->Debit;
             $student_account->description = $request->description;
             $student_account->save();

             DB::commit();

             return redirect()->route('processingFee.index')->with('success',trans('messages.success'));

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
        return view('pages.processing_fee.show',compact('student'));
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findOrFail($id);
        return view('pages.processing_fee.edit',compact('ProcessingFee'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            // تعديل البيانات فى جدول معالجة الرسوم
            $processingFee = ProcessingFee::findOrFail($request->id);
            $processingFee->date = date('Y-m-d');
            $processingFee->student_id =$request->student_id;
            $processingFee->amount = $request->Debit;
            $processingFee->description = $request->description;
            $processingFee->save();

            // تعديل البيانات فى جدول حساب الطالب
            $student_account = StudentAccount::where('processingfee_id',$request->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'processingFee';
            $student_account->student_id = $request->student_id;
            $student_account->processingfee_id = $processingFee->id;
            $student_account->Debit = 0.00;
            $student_account->Credit = $request->Debit;
            $student_account->description = $request->description;
            $student_account->save();

            DB::commit();

            return redirect()->route('processingFee.index')->with('success',trans('messages.update'));

        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $ProcessingFee = ProcessingFee::findOrFail($request->id);
        $ProcessingFee->delete();

        return redirect()->route('processingFee.index')->with('success',trans('messages.delete'));

    }
}
