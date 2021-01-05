<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Educator extends Model
{
    protected $fillable = [
        'user_id',
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
