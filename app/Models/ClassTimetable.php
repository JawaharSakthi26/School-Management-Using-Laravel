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
}
