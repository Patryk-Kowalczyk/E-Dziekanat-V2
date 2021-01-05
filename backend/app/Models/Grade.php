<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'value',
        'id_subject',
        'id_student'
    ];



}
