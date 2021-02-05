<?php


namespace App\MyApp\Subject\Transforms;
use App\Models\Grade;
use League\Fractal\Manager;
use App\MyApp\Grade\Transforms\PartialGradeStudentTransformer;
use League\Fractal\Scope;
use League\Fractal\TransformerAbstract;

class SubjectWithGradesTransform extends TransformerAbstract
{
    public function transform(Grade $grade): array
    {
        return [
            'id'=> (int) $grade->subjects[0]->id,
            'name'=> (string) $grade->subjects[0]->name,
            'form'=> (string) $grade->subjects[0]->form,
            'hours'=> (int) $grade->subjects[0]->hours,
            'grades' => $this->includeGrades($grade)
        ];
    }

    public function includeGrades(Grade $grade): Scope
    {
        $fractal = new Manager;
        $test= $this->item($grade, new PartialGradeStudentTransformer);
        return $fractal->createData($test);
    }
}

