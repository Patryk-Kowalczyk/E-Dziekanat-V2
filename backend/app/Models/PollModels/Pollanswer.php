<?php

namespace App\Models\PollModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollanswer extends Model
{
    protected $hidden = ['created_at','updated_at'];

    public function pollquestion()
    {
        return $this->belongsTo(Pollquestion::class);
    }

    public function pollstudent()
    {
        return $this->belongsTo(Pollstudent::class);
    }

}
