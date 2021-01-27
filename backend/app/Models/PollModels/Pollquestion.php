<?php

namespace App\Models\PollModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollquestion extends Model
{

    protected $hidden = ['created_at','updated_at'];

    public function pollanswers()
    {
        return $this->hasMany(Pollanswer::class,'question_id');
    }

    public function pollstudents()
    {
        return $this->hasMany(Pollstudent::class,'question_id');
    }

}
