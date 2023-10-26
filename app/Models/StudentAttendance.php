<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'class_id', 'attendance_date', 'student_id', 'attendance_type'
    ];

    // public function getLeavecount($date){
    //     return $this->where('attendance_type',1)->whereDate($date)->count();
    // }

    public function class(){
        return $this->belongsTo(AddClass::class,'class_id');
    }

    public function statuses(){
        return $this->hasMany(StudentAttendanceStatus::class,'attendance_date_id', 'id');
    }
}
