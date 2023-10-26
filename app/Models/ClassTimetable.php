<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTimetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'subject_id',
        'day_id',
        'teacher_id',
        'start_time',
        'end_time'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function class(){
        return $this->belongsTo(AddClass::class,'class_id');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }

    public function day(){
        return $this->belongsTo(Day::class,'day_id');
    }
}
