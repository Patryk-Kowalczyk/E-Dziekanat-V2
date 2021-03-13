<?php


namespace App\MyApp\Grade\Transforms;

use App\Models\FinalGrade;
use App\Models\Subject;
use League\Fractal\TransformerAbstract;

class FinalGradeEducatorPanelTransformer extends TransformerAbstract
{
    public function transform(FinalGrade $finalGrade):array
    {
        return [
            'id_finalgrade'=> $finalGrade->id,
            'first_name'=> $finalGrade->student->user->first_name,
            'last_name'=> $finalGrade->student->user->last_name,
            'album'=> $finalGrade->student->album,
            'group'=> $finalGrade->student->group->name,
            'group_id'=> $finalGrade->student->group->id,
            'first_term'=> $finalGrade->first_term,
            'first_repeat'=> $finalGrade->first_repeat,
            'second_repeat'=> $finalGrade->second_repeat,
            'committee'=> $finalGrade->committee,
            'promotion'=> $finalGrade->promotion,
        ];
    }
}
