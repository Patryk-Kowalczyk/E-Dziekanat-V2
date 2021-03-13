<?php


namespace App\MyApp\Subject\Transforms;

use App\Models\Grade;
use App\MyApp\Grade\Transforms\PartialGradeStudentTransformer;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

class StudentWithPartialGradesTransformer extends TransformerAbstract
{
    public function transform(Grade $grade): array
    {
        return [

            'first_name'=> (string) $grade->student->user->first_name,
            'last_name'=> (string) $grade->student->user->last_name,
            'album'=> (int) $grade->student->album,
            'group'=> (int) $grade->student->group->name,
            'group_id'=> (int) $grade->student->group->id,
            'grades'=>  $this->includeGrades($grade)
            ];
    }

    public function includeGrades(Grade $grade)
    {
        $fractal = new Manager;
        $gradesStudent= $this->item($grade, new PartialGradeStudentTransformer);
        return $fractal->createData($gradesStudent);
    }

}

