<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'class_id',
        'phone',
        'gender',
        'dob',
        'admission_id',
        'roll_number',
        'religion',
        'blood_group',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function class(){
        return $this->belongsTo(AddClass::class, 'class_id');
    }
}