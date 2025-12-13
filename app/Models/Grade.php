<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = ['name','notes'];

    public function classRooms()
    {
        return $this->hasMany('App\Models\ClassRoom');
    }

    public function Sections()
    {
        return $this->hasMany('App\Models\Section','grade_id');
    }
}
