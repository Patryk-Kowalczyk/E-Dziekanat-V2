<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'value','student_id',
    ];

    protected $hidden = ['pivot'];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'subjects_grades');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
