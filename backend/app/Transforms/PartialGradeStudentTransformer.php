<?php


namespace App\Transforms;


use App\Http\Traits\dateFormatTrait;
use App\Models\Grade;
use League\Fractal\TransformerAbstract;

class PartialGradeStudentTransformer extends TransformerAbstract
{
    public function transform(Grade $grade)
    {
        return [
            'name'=>  $grade->subjects[0]->name,
            'form'=>  $grade->subjects[0]->form,
            'value'=>  $grade->value,
            'date' => dateFormatTrait::format_Ymd_Hi($grade->created_at)
        ];
    }


}
