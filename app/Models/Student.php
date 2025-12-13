<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use SoftDeletes;
    use HasTranslations;
    public $table = 'students';

    protected $fillable = ['id' , 'name' , 'email' , 'password','gender_id', 'nationality_id', 'blood_id', 'Date_Birth', 'grade_id', 'classroom_id', 'section_id', 'parent_id', 'academic_year'];
    protected $hidden = ['password'];
    public $translatable = ['name'];
    protected $guarded = [];
   // protected $casts = [];



    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image','imageable');
    }

    public function Nationality()
    {
        return $this->belongsTo('App\Models\Nationalitie','nationality_id');
    }

    public function myParent()
    {
        return $this->belongsTo('App\Models\MyParent','parent_id');
    }

    public function studentAccount()
    {
        return $this->hasMany('App\Models\StudentAccount','student_id');
    }

    public function attendance()
    {
        return $this->hasMany('App\Models\Attendance','student_id');
    }
}
