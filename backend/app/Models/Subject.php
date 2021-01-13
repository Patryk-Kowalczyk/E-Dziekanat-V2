<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subject extends Model
{
    protected $fillable = [
        'educator_id',
        'name',
        'form'
    ];

    public function plans()
    {
        return $this->belongsToMany(Plan::class,'plans_subjects');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class,'subjects_grades');
    }

    public function educators()
    {
        return $this->belongsToMany(Grade::class,'subjects_educators');
    }


}
