<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','name','status'
    ];
    
    public function student(){
        return $this->hasMany(Student::class, 'class_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
