<?php


namespace App\MyApp\Subject\Transforms;

use App\Models\Subject;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

class EducatorPanelSubjectsWithPartialGradesTransformer extends TransformerAbstract
{
    public function transform(Subject $subject):array
    {
        return [
            'id'=> (int) $subject->id,
            'name'=> (string) $subject->name,
            'form'=> (string) $subject->form,
            'students'=> $this->includeStudents($subject),
        ];
    }

    public function includeStudents(Subject $subject)
    {
        $fractal = new Manager;
        $gradesStudent= $this->collection($subject->grades, new StudentWithPartialGradesTransformer);
        return $fractal->createData($gradesStudent);
    }
}
