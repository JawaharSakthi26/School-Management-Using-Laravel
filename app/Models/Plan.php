<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','class_id','plan_id','name','billing_method','interval_count','amount','currency'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function class(){
        return $this->belongsTo(AddClass::class,'class_id');
    }
}