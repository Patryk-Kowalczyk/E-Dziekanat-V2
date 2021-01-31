<?php

namespace App\Models;

use App\Models\PollModels\Pollstudent;
use App\Models\SelectSubjectModels\Studentchoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Student extends Model
{
    protected $fillable = [
        'album',
        'user_id',
        'group_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function finalgrades()
    {

        return $this->hasMany(FinalGrade::class);
    }

    public function studentchoices()
    {

        return $this->hasMany(Studentchoice::class);
    }

    public function pollstudents()
    {
        return $this->hasMany(Pollstudent::class);
    }



    //===================================================//
    public function getGroupId()
    {
        return $this->group->id;
    }

}
