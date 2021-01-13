<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{


    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subjects_grades');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
