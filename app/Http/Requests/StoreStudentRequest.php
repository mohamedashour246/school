<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' =>'required',
            'name_en' =>'required',
            'email' =>'required|email|unique:students',
            'password' =>'required|min:6',
            'gender_id' =>'required',
            'blood_id' =>'required',
            'Date_Birth' =>'required',
            'Grade_id' =>'required',
            'Classroom_id' =>'required',
            'section_id' =>'required',
            'parent_id' =>'required',
            'academic_year' =>'required',

        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'من فضلك ادخل اسم الطالب باللغة العربية',
            'name_en.required' => 'من فضلك ادخل اسم الطالب باللغة الانجليزية',
            'email.required' => 'من فضلك ادخل البريد الالكترونى',
            'email.email' => 'يجب ادخال بريد الكترونى صالح',
            'email.unique' => 'هذا البريد مستخدم من قبل',
            'password.required' => 'من فضلك ادخل كلمة المرور',
            'password.min' => 'يجب الا تقل كلمة المرور عن 6 احرف',
            'gender_id.required' => 'من فضلك ادخل النوع',
            'blood_id.required' => 'من فضلك ادخل فصيلة الدم',
            'Date_Birth.required' => 'من فضلك ادخل تاريخ الميلاد',
            'Grade_id.required' => 'من فضلك ادخل المرحلة الدراسية',
            'Classroom_id.required' => 'من فضلك ادخل الصف الدراسى',
            'section_id.required' => 'من فضلك ادخل القسم',
            'parent_id.required' => 'من فضلك ادخل ولى الامر',
            'academic_year.required' => 'من فضلك ادخل السنة الدراسية',
        ];
    }
}
