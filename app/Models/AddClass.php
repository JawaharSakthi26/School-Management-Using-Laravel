<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'status'
    ];

    public function subjects(){
        return $this->hasMany(ClassSubject::class,'class_id','id');
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
