<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddParentRequest extends FormRequest
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

        ];
    }

//    public function messages()
//    {
//        return
//            [
//
//            'Email.required' => 'الايميل مطلوب',
//            'Password.required' => 'الرقم السرى مطلوب',
//            'Name_Father.required' => trans('main_trans.Name_Father').' مطلوب',
//            'Name_Father_en.required' => trans('main_trans.Name_Father_en').' مطلوب',
//            'Job_Father.required' => trans('main_trans.Job_Father').' مطلوب',
//            'Job_Father_en.required' => trans('main_trans.Job_Father_en').' مطلوب',
//            'National_ID_Father.required' => trans('main_trans.National_ID_Father').' مطلوب',
//            'Passport_ID_Father.required' => trans('main_trans.Passport_ID_Father').' مطلوب',
//            'Phone_Father.required' => trans('main_trans.Phone_Father').' مطلوب',
//            'Nationality_Father_id.required' => trans('main_trans.Nationality_Father_id').' مطلوب',
//            'Blood_Type_Father_id.required' => trans('main_trans.Blood_Type_Father_id').' مطلوب',
//            'Religion_Father_id.required' => trans('main_trans.Religion_Father_id').' مطلوب' ,
//            'Address_Father.required' => trans('main_trans.Address_Father').' مطلوب',
//
//            'Name_Mother.required' => trans('main_trans.Name_Mother').' مطلوب',
//            'Name_Mother_en.required' => trans('main_trans.Name_Mother_en').' مطلوب',
//            'Job_Mother.required' => trans('main_trans.Job_Mother').' مطلوب',
//            'Job_Mother_en.required' => trans('main_trans.Job_Mother_en').' مطلوب',
//            'National_ID_Mother.required' => trans('main_trans.National_ID_Mother').' مطلوب',
//            'Passport_ID_Mother.required' => trans('main_trans.Passport_ID_Mother').' مطلوب',
//            'Phone_Mother.required' => trans('main_trans.Phone_Mother').' مطلوب',
//            'Nationality_Mother_id.required' => trans('main_trans.Nationality_Mother_id').' مطلوب',
//            'Blood_Type_Mother_id.required' => trans('main_trans.Blood_Type_Mother_id').' مطلوب',
//            'Religion_Mother_id.required' => trans('main_trans.Religion_Mother_id').' مطلوب' ,
//            'Address_Mother.required' => trans('main_trans.Address_Mother').' مطلوب',
//       ];
   // }
}
