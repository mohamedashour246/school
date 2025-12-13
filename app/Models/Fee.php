<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasTranslations;

    public $translatable = ['title'];
    protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }
}
