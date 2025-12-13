<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Authenticatable
{
    use HasTranslations;

    // public $fillable = ['email','name_father','national_id_father','phone_father'];
    public $guarded = [];
    public $table = 'my_parents';
    public $translatable = ['name_father','job_father','name_mother','job_mother'];
}
