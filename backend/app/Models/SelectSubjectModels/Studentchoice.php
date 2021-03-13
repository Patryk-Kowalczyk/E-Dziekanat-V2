<?php

namespace App\Models\SelectSubjectModels;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentchoice extends Model
{

    public function option()
    {
        return $this->hasOne(Option::class);
    }

    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


}
