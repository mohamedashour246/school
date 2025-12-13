<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizzeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'subject_id' => 'required',
            'Grade_id' => 'required',
            'Class_id' => 'required',
            'section_id' => 'required',
            'teacher_id' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'Name_ar.required' => 'ادخل اسم الاختبار باللعة العربية',
            'Name_en.required' => 'ادخل اسم الاختبار باللغة الانجليزية',
            'subject_id.required' => 'ادخل المادة الدراسية',
            'Grade_id.required' => 'ادخل المرحلة الدراسية',
            'Class_id.required' => 'ادخل الصف الدراسى',
            'section_id.required' => 'ادخل القسم',
            'teacher_id.required' => 'ادخل اسم المعلم',

        ];
    }
}
