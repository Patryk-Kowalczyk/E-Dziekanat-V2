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

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subjects_educators');
    }

    public function plan()
    {
        return $this->hasMany(Plan::class,'educator_id');
    }

}
