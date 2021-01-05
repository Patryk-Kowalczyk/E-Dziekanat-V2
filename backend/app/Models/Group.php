<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name'
    ];

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class,'group_id');
    }

}
