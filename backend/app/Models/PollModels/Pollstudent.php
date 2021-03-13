<?php

namespace App\Models\PollModels;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollstudent extends Model
{

    public function pollanswer()
    {
        return $this->hasOne(Pollanswer::class,'answer_id');
    }

    public function pollquestion()
    {
        return $this->belongsTo(Pollquestion::class,'question_id');
    }

    public function pollname()
    {
        return $this->belongsTo(Pollname::class,'poll_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
