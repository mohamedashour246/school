<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{
    public function getPromotions()
    {
        $grades = Grade::all();
        return view('pages.students.promotions.index',compact('grades'));
    }

    public function getPromotionStudent()
    {
        $promotions = Promotion::all();
        return view('pages.students.promotions.management',compact('promotions'));
    }

    public function storePromotions($request)
    {
        DB::beginTransaction();

        try {

            $students = Student::where('grade_id', $request->Grade_id)->where('classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->where('academic_year',$request->academic_year)->get();

            if($students->count() < 1)
            {
                return redirect()->back()->with('fail','لا توجد بيانات فى جدول الطلاب');
            }

            foreach ($students as $student) {
                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)->
                update([
                    'grade_id' => $request->Grade_id_new,
                    'classroom_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                    'academic_year'  => $request->academic_year_new,
                ]);
//            $promotions = new Promotion();
//            $promotions->student_id = $student->id;
//            $promotions->from_grade  = $request->Grade_id;
//            $promotions->from_classroom = $request->Classroom_id;
//            $promotions->from_section = $request->section_id;
//            $promotions->to_grade  = $request->Grade_id_new;
//            $promotions->to_classroom  = $request->Classroom_id_new;
//            $promotions->to_section = $request->section_id_new;
//
//            $promotions->save();

                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
             DB::commit();
            return redirect()->route('promotions.index')->with('success', trans('messages.success'));
        }

        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function destroy($request)
    {
        DB::beginTransaction();

        try {
            if($request->page_id  == 1)
            {
                $promotions = Promotion::all();
                foreach ($promotions as $promotion)
                {
                    $ids = explode(',',$promotion->student_id);
                    Student::whereIn('id',$ids)->
                        update([
                            'grade_id' => $promotion->from_grade,
                            'classroom_id' => $promotion->from_classroom,
                            'section_id' => $promotion->from_section,
                            'academic_year' => $promotion->academic_year,
                    ]);

                    Promotion::truncate();

                }
                DB::commit();
                return redirect()->back()->with('success',trans('messages.delete'));
            }
            else {

                $promotion = Promotion::findOrFail($request->id);
                Student::where('id',$promotion->student_id)
                    ->update([
                    'grade_id' => $promotion->from_grade,
                    'classroom_id' => $promotion->from_classroom,
                    'section_id' => $promotion->from_section,
                    'academic_year' => $promotion->academic_year,
                ]);

                Promotion::destroy($request->id);

                DB::commit();
                return redirect()->back()->with('success',trans('messages.delete'));
            }
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
