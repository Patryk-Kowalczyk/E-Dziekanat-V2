<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Educator extends Model
{
    protected $fillable = [
            'title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function plan()
    {
        return $this->hasMany(Plan::class,'educator_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    //=========================================//

    public function getFullName()
    {
        return $this->title.' '. $this->user->first_name. ' '.$this->user->last_name;
    }

}
