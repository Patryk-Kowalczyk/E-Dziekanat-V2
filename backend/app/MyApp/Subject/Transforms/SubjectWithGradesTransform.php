<?php


namespace App\MyApp\Subject\Transforms;
use League\Fractal\Manager;

use App\Models\Subject;
use App\MyApp\Grade\Transforms\PartialGradeStudentTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class SubjectWithGradesTransform extends TransformerAbstract
{
    protected $availableIncludes = [
        'grades'
    ];


    public function transform(Subject $subject): array
    {
        return [
            'name'=> (string) $subject->name,
            'form'=> (string) $subject->form,
            'test' => $this->includeGrades($subject)
        ];
    }

    public function includeGrades(Subject $subject): \League\Fractal\Scope
    {
        $fractal = new Manager ;
        $grades=$subject->grades;
        $x= $this->collection($grades, new PartialGradeStudentTransformer);
        return $fractal->createData($x);
    }

}
