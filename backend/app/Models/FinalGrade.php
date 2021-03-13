<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalGrade extends Model
{
    protected $fillable = [
        'id',
        'first_term',
        'first_repeat',
        'second_repeat',
        'committee',
        'promotion'
    ];
    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

}
