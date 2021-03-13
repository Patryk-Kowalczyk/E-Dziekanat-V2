<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $hidden = ['educator_id'];

    public function educator()
    {
        return $this->belongsTo(Educator::class);
    }
}
