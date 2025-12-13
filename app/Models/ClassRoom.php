<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasTranslations;
    public $translatable = ['name_class'];

    protected $fillable = ['name_class','grade_id'];

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }

//    public function sections()
//    {
//        return $this->hasMany('App\Models\Section','grade_id');
//    }
}
