<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'group_id',
        'roll_number',
        'gender',
        'phone',
        'dateofbirth',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
