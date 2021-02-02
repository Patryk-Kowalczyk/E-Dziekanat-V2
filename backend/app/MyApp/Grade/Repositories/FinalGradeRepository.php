<?php

declare(strict_types=1);

namespace App\MyApp\Grade\Repositories;

use App\Models\FinalGrade;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class FinalGradeRepository
{
    protected $finalGrade;

    public function __construct(FinalGrade $finalGrade)
    {
        $this->finalGrade = $finalGrade;
    }

    public function getAll()
    {
        return $this->finalGrade->get();
    }

    public function getByStudentId($id)
    {
        return $this->getAll()->where('student_id',$id);
    }




}
