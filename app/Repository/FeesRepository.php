<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Fee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::all();
        return view('pages.fees.index',compact('fees'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.fees.create',compact('Grades'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
              $validator = Validator::make($request->all() ,[
                   'title_ar' => 'required',
                   'title_en' => 'required',
                   'amount' => 'required',
                   'Grade_id' => 'required',
                   'year' => 'required',
              ],
              [
                  'title_ar.required' => 'من فضلك ادخل اسم الرسوم باللغة العربية',
                  'title_en.required' => 'من فضلك ادخل اسم الرسوم باللغة الانجليزية',
                  'amount.required' => 'من فضلك ادخل المبلغ',
                  'Grade_id.required' => 'من فضلك ادخل المرحلة الدراسية',
                  'year.required' => 'من فضلك ادخل السنة الدراسية',
              ]);

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $fees = new Fee();
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amoumt = $request->amount;
            $fees->grade_id = $request->Grade_id;
            $fees->classroom_id = $request->Classroom_id;
            $fees->year = $request->year;
            $fees->description = $request->description;
            $fees->fee_type = $request->fee_type;

            $fees->save();

            DB::commit();

            return redirect()->route('fees.index')->with('success',trans('messages.success'));
        }

        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $Grades = Grade::all();
        return view('pages.fees.edit',compact('fee','Grades'));
    }

    public function update($request)
    {
        DB::beginTransaction();

         try {
             $validator = Validator::make($request->all() ,[
                 'title_ar' => 'required',
                 'title_en' => 'required',
                 'amount' => 'required',
                 'Grade_id' => 'required',
                 'year' => 'required',
             ],
                 [
                     'title_ar.required' => 'من فضلك ادخل اسم الرسوم باللغة العربية',
                     'title_en.required' => 'من فضلك ادخل اسم الرسوم باللغة الانجليزية',
                     'amount.required' => 'من فضلك ادخل المبلغ',
                     'Grade_id.required' => 'من فضلك ادخل المرحلة الدراسية',
                     'year.required' => 'من فضلك ادخل السنة الدراسية',
                 ]);

             if($validator->fails())
             {
                 return redirect()->back()->withErrors($validator)->withInput();
             }

             $fees = Fee::findOrFail($request->id);
             $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
             $fees->amoumt  =$request->amount;
             $fees->grade_id  =$request->Grade_id;
             $fees->classroom_id  =$request->Classroom_id;
             $fees->description  =$request->description;
             $fees->year  =$request->year;
             $fees->fee_type = $request->fee_type;
             $fees->update();

             DB::commit();
             return redirect()->route('fees.index')->with('success',trans('messages.update'));

         }

         catch (\Exception $e)
         {
             DB::rollBack();
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
         }
    }

    public function destroy($request)
    {
        $fee = Fee::findOrFail($request->id);
        $fee->delete();

        return redirect()->route('fees.index')->with('success',trans('messages.delete'));
    }


}
