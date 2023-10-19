<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id','class_id','subject_id'
    ];

    public function class(){
        return $this->belongsTo(AddClass::class);
    }
}
