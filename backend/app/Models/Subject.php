<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subject extends Model
{
    protected $fillable = [

    ];

    protected $hidden = ['pivot','id','educator_id','first_term','first_repeat','second_repeat','committee','promotion','ECTS'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class,'plans_subjects');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class,'subjects_grades');
    }

    public function educator()
    {
        return $this->belongsTo(Educator::class);
    }

    public function finalgrades()
    {
        return $this->hasMany(FinalGrade::class);
    }



}
