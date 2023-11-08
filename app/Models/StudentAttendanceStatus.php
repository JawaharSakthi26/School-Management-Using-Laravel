<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceStatus extends Model
{
    use HasFactory;

    protected $fillable= [
        'attendance_date_id','student_id','status'
    ];

    public function attendance(){
        return $this->belongsTo(StudentAttendance::class,'attendance_date_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'student_id');
    }
}
