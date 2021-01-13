<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Plan extends Model
{
    protected $fillable = [
        'since',
        'to',
        'room',
        'date',
        'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'plans_subjects');
    }

}
