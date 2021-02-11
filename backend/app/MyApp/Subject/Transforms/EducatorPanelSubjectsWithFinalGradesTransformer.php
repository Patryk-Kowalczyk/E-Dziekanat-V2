<?php


namespace App\MyApp\Subject\Transforms;

use App\Models\Subject;
use App\MyApp\Grade\Transforms\FinalGradeEducatorPanelTransformer;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

class EducatorPanelSubjectsWithFinalGradesTransformer extends TransformerAbstract
{
    public function transform(Subject $subject):array
    {
        return [
            'id'=> (int) $subject->id,
            'name'=> (string) $subject->name,
            'form'=> (string) $subject->form,
            'grades'=> $this->includeFinalGrades($subject),
        ];
    }

    public function includeFinalGrades(Subject $subject)
    {
        $fractal = new Manager;
        $gradesStudent= $this->collection($subject->finalgrades, new FinalGradeEducatorPanelTransformer);
        return $fractal->createData($gradesStudent);
    }
}
