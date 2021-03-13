<?php

namespace App\Models\SelectSubjectModels;

use App\Models\SelectSubjectModels;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    public function studentchoice()
    {
        return $this->belongsTo(Studentchoice::class);
    }

}
