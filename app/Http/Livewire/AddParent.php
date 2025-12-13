<?php

namespace App\Http\Livewire;

use App\Http\Requests\AddParentRequest;
use App\Http\Traits\AttachFilesTrait;
use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\TypeBlood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads, AttachFilesTrait;

    public $successMessage = '';

    public $photos , $show_table = true , $parent_id;

    public $updateMode = false;

    public $currentStep = 1,
        // Father input
        $Email,$Password,$Name_Father,$Name_Father_en,
        $Job_Father,$Job_Father_en,$National_ID_Father,$Passport_ID_Father,
        $Phone_Father,$Nationality_Father_id,$Blood_Type_Father_id,
        $Religion_Father_id,$Address_Father ,

        // Mother input
        $Name_Mother,$Name_Mother_en,
        $Job_Mother,$Job_Mother_en,$National_ID_Mother,$Passport_ID_Mother,
        $Phone_Mother,$Nationality_Mother_id,$Blood_Type_Mother_id,
        $Religion_Mother_id,$Address_Mother ;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'Email' => 'required|email',
        ]);
    }

    public function render()
    {
        $Nationalities = Nationalitie::all();
        $Type_Bloods = TypeBlood::all();
        $Religions = Religion::all();
        $my_parents = MyParent::all();

        return view('livewire.add-parent',compact('Nationalities','Type_Bloods','Religions','my_parents'));
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'Email'  => 'required|email',
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required',
            'Passport_ID_Father' => 'required',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function showFormAdd()
    {
        $this->show_table = false;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function secondStepSubmit()
    {
        $this->validate([

            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required',
            'Passport_ID_Mother' => 'required',
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm()
    {
        $my_parent = new MyParent();

        // Father_input
        $my_parent->email = $this->Email;
        $my_parent->password = Hash::make($this->Password);
        $my_parent->name_father = ['en' => $this->Name_Father_en ,
            'ar' =>  $this->Name_Father];
        $my_parent->national_id_father = $this->National_ID_Father;
        $my_parent->passport_id_father = $this->Passport_ID_Father;
        $my_parent->phone_father = $this->Phone_Father;
        $my_parent->job_father =['en' => $this->Job_Father_en ,
            'ar' =>  $this->Job_Father];
        $my_parent->nationality_father_id = $this->Nationality_Father_id;
        $my_parent->blood_type_father_id = $this->Blood_Type_Father_id;
        $my_parent->religion_father_id = $this->Religion_Father_id;
        $my_parent->address_father = $this->Address_Father;

        // Mother_input
        $my_parent->name_mother = ['en' => $this->Name_Mother_en ,
            'ar' =>  $this->Name_Mother];
        $my_parent->national_id_mother = $this->National_ID_Mother;
        $my_parent->passport_id_mother = $this->Passport_ID_Mother;
        $my_parent->phone_mother = $this->Phone_Mother;
        $my_parent->job_mother =['en' => $this->Job_Mother_en ,
            'ar' =>  $this->Job_Mother];
        $my_parent->nationality_mother_id = $this->Nationality_Mother_id;
        $my_parent->blood_type_mother_id = $this->Blood_Type_Mother_id;
        $my_parent->religion_mother_id = $this->Religion_Mother_id;
        $my_parent->address_mother = $this->Address_Mother;

        $my_parent->save();

        if(!empty($this->photos))
        {
            foreach($this->photos as $photo)
            {
                $photo->storeAs('parent_attachments/'.$this->National_ID_Father,
                    $photo->getClientOriginalName(),'parent_attachments');

                ParentAttachment::create([
                    'file_name'  => $photo->getClientOriginalName(),
                    'parent_id'  => MyParent::latest()->first()->id,
                ]);
            }
        }

        $this->successMessage = trans('messages.success');
        $this->clearForm();

        $this->currentStep = 1;
    }

    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $my_parent = MyParent::where('id',$id)->first();
        $this->parent_id = $id;
        $this->Email = $my_parent->email;
        $this->Password = $my_parent->password;

        $this->Name_Father = $my_parent->getTranslation('name_father','ar');
        $this->Name_Father_en = $my_parent->getTranslation('name_father','en');
        $this->Job_Father = $my_parent->getTranslation('job_father','ar');
        $this->Job_Father_en = $my_parent->getTranslation('job_father','en');
        $this->National_ID_Father = $my_parent->national_id_father;
        $this->Passport_ID_Father = $my_parent->passport_id_father;
        $this->Phone_Father = $my_parent->phone_father;
        $this->Nationality_Father_id = $my_parent->nationality_father_id;
        $this->Blood_Type_Father_id = $my_parent->blood_type_father_id;
        $this->Religion_Father_id = $my_parent->religion_father_id;
        $this->Address_Father = $my_parent->address_father;

        $this->Name_Mother = $my_parent->getTranslation('name_mother','ar');
        $this->Name_Mother_en = $my_parent->getTranslation('name_mother','en');
        $this->Job_Mother = $my_parent->getTranslation('job_mother','ar');
        $this->Job_Mother_en = $my_parent->getTranslation('job_mother','en');
        $this->National_ID_Mother = $my_parent->national_id_mother;
        $this->Passport_ID_Mother = $my_parent->passport_id_mother;
        $this->Phone_Mother = $my_parent->phone_mother;
        $this->Nationality_Mother_id = $my_parent->nationality_mother_id;
        $this->Blood_Type_Mother_id = $my_parent->blood_type_mother_id;
        $this->Religion_Mother_id = $my_parent->religion_mother_id;
        $this->Address_Mother = $my_parent->address_mother;
    }

    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }

    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function submitForm_edit()
    {
        if($this->parent_id)
        {
            $parent = MyParent::find($this->parent_id);
            // $parent->update([
            //       'passport_id_father' => $this->Passport_ID_Father,
            //       'national_id_father' => $this->National_ID_Father,
            // ]);

            $parent->passport_id_father = $this->Passport_ID_Father;
            $parent->national_id_father = $this->National_ID_Father;
            $parent->password = Hash::make($this->Password);
            $parent->update();

        }

        return redirect()->to('/add_parent')->with('success',trans('messages.update'));
    }

    public function delete($id)
    {
        MyParent::findOrFail($id)->delete();

        return redirect()->to('/add_parent')->with('success',trans('messages.delete'));
    }
}
