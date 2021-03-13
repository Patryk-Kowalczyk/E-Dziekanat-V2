<?php

declare(strict_types=1);

namespace App\MyApp\Subject\Repositories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SubjectRepository
{
    protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function find($id): Model
    {
        return $this->subject->find($id);
    }

    public function getAll(): Collection
    {
        return $this->subject->get();
    }

    public function getStudentSubjectsWithPartialGrades($id): Collection
    {
        return $this->subject->with(['grades' => function ($q) use ($id) {
            $q->select(['grades.category', 'grades.value', 'grades.comments', 'grades.created_at as date'])
                ->where('grades.student_id', $id);
        }])->get();
    }

    public function getSubjectsForPanelEducator($id): Collection
    {
        return $this->getAll()->where('educator_id', $id);
    }
}
