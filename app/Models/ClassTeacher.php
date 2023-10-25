<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','class_id','teacher_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function class(){
        return $this->belongsTo(AddClass::class,'class_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id');
    }
}
