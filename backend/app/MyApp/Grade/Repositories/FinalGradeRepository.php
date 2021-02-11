<?php

declare(strict_types=1);

namespace App\MyApp\Grade\Repositories;

use App\Models\FinalGrade;


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


    public function updateFinalGrade($data)
    {
        return $this->finalGrade->find($data['id'])->update($data);
    }






}
