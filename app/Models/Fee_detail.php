<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee_detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','class_id','term','amount','due_date'
    ];

    public function class(){
        return $this->belongsTo(AddClass::class,'class_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
