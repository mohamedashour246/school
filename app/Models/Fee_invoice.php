<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee_invoice extends Model
{
    public $table = 'fee_invoices';
    protected $fillable = ['grade_id','classroom_id'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student','student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Models\Fee','fee_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade','grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\ClassRoom','classroom_id');
    }
}
