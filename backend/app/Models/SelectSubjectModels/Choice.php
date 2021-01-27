<?php

namespace App\Models\SelectSubjectModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{


    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function studentchoices()
    {
        return $this->hasMany(Studentchoice::class);
    }

}
