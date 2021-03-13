<?php

namespace App\Models\PollModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollname extends Model
{

    public function pollstudent()
    {
        return $this->hasMany(Pollstudent::class,'poll_id');
    }
}
