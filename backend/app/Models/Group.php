<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name'
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class,'group_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subjects_groups');
    }

}
