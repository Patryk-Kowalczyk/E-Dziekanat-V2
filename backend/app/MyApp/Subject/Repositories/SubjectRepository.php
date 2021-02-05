<?php

declare(strict_types=1);

namespace App\MyApp\Subject\Repositories;

use App\Models\Subject;


class SubjectRepository
{
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function getAll()
    {
        return $this->subject->get();
    }

    public function getStudentSubjectsWithPartialGrades($id)
    {
        return $this->subject->with(['grades' => function ($q) use ($id) {
            $q->select(['grades.category', 'grades.value', 'grades.comments', 'grades.created_at as date'])
                ->where('grades.student_id', $id);
        }])->get();
    }

}
