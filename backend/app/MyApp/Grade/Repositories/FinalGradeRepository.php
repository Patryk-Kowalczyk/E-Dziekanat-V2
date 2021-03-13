<?php

declare(strict_types=1);

namespace App\MyApp\Grade\Repositories;

use App\Models\FinalGrade;
use Illuminate\Database\Eloquent\Collection;

class FinalGradeRepository
{
    protected $finalGrade;

    public function __construct(FinalGrade $finalGrade)
    {
        $this->finalGrade = $finalGrade;
    }

    public function getAll(): Collection
    {
        return $this->finalGrade->get();
    }

    public function getByStudentId($id): Collection
    {
        return $this->getAll()->where('student_id', $id);
    }

    public function updateFinalGrade($data): bool
    {
        return $this->finalGrade->find($data['id'])->update($data);
    }
}
