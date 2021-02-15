<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'id', 'name'
    ];

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plans_subjects');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'subjects_grades');
    }

    public function educator()
    {
        return $this->belongsTo(Educator::class);
    }

    public function finalgrades()
    {
        return $this->hasMany(FinalGrade::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'subjects_groups');
    }
}
