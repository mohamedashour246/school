<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    public $fillable = ['grade_id','classroom_id','section_id','user_id','meeting_id','topic','start_at','duration','password','start_url','join_url'];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\ClassRoom');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
