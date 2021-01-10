<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subject extends Model
{
    protected $fillable = [
        'id_educator',
        'name',
        'form'
    ];

    public function schedule()
    {
        return $this->hasOne(Plan::class);
    }


}
