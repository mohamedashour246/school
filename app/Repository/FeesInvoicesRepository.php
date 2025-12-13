<?php


namespace App\Repository;


use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeesInvoicesRepository implements FeesInvoicesRepositoryInterface
{
    public function index()
    {
        $Fee_invoices = Fee_invoice::all();
        return view('pages.fees_invoices.index',compact('Fee_invoices'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classroom_id',$student->classroom_id)->get();

        //$fees = Fee::all();

        return view('pages.fees_invoices.add',compact('student','fees'));
    }

    public function store($request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try
        {
           foreach ($List_Fees as $list_Fee)
           {
               //   حفظ البيانات فى جدول فواتير الرسوم الدراسية
               $Fees = new Fee_invoice();
               $Fees->invoice_date = date('Y-m-d');
               $Fees->student_id  = $list_Fee['student_id'];
               $Fees->grade_id = $request->grade_id;
               $Fees->classroom_id = $request->classroom_id;
               $Fees->fee_id  = $list_Fee['fee_id'];
               $Fees->amount  = $list_Fee['amount'];
               $Fees->description = $list_Fee['description'];
               $Fees->save();

               // حفظ البيانات فى جدول حسابات الطلاب
               $studentAccount = new StudentAccount();
               $studentAccount->student_id = $list_Fee['student_id'];
               $studentAccount->date = date('Y-m-d');
               $studentAccount->type = 'invoice';
               $studentAccount->fee_invoice_id = $Fees->id;
               $studentAccount->grade_id = $request->grade_id;
               $studentAccount->classroom_id = $request->classroom_id;
               $studentAccount->Debit = $list_Fee['amount'];
               $studentAccount->Credit = 0.00;
               $studentAccount->description = $list_Fee['description'];

               $studentAccount->save();

           }

           DB::commit();

           return redirect()->route('FeesInvoices.index')->with('success',trans('messages.success'));
        }

        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $Fee_invoices = Fee_invoice::findOrFail($id);
        $fees = Fee::all();

        return view('pages.fees_invoices.edit',compact('Fee_invoices','fees'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
            $Fee_invoices = Fee_invoice::findOrFail($request->id);
            $Fee_invoices->fee_id = $request->fee_id;
            $Fee_invoices->amount = $request->amount;
            $Fee_invoices->description = $request->description;
            $Fee_invoices->update();

            $studentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
            $studentAccount->Debit = $request->amount;
            $studentAccount->description = $request->description;
            $studentAccount->update();

            DB::commit();

            return redirect()->route('FeesInvoices.index')->with('success',trans('messages.update'));

        }

        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $Fee_invoices = Fee_invoice::findOrFail($request->id);
        $Fee_invoices->delete();

        return redirect()->route('FeesInvoices.index')->with('success',trans('messages.delete'));

    }

}
