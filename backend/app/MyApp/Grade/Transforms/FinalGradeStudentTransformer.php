<?php


namespace App\MyApp\Grade\Transforms;

use App\Models\FinalGrade;
use League\Fractal\TransformerAbstract;

class FinalGradeStudentTransformer extends TransformerAbstract
{
    public function transform(FinalGrade $finalGrade):array
    {
        return [
            'name'=> (string) $finalGrade->subject->name,
            'form'=> (string) $finalGrade->subject->form,
            'educator'=> (string) $finalGrade->subject->educator->getFullName(),
            'hours'=>  $finalGrade->subject->hours,
            'first_term'=> $finalGrade->first_term,
            'first_repeat' => $finalGrade->first_repeat,
            'second_repeat' => $finalGrade->second_repeat,
            'committee' => $finalGrade->committee,
            'promotion' => $finalGrade->promotion,
            'ECTS' => $finalGrade->subject->ECTS,
        ];
    }
}
