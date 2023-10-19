<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gender',
        'dob',
        'blood_group',
        'phone',
        'joining_date',
        'qualification',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
