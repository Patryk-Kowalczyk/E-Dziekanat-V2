<?php


namespace App\MyApp\Grade\Transforms;


use App\Http\Traits\DateFormatTrait;
use App\Models\Grade;
use League\Fractal\TransformerAbstract;

class DashboardPartialGradeStudentTransformer extends TransformerAbstract
{
    public function transform(Grade $grade): array
    {
        return [
            'name'=>  $grade->subjects[0]->name,
            'form'=>  $grade->subjects[0]->form,
            'value'=>  $grade->value,
            'date' => DateFormatTrait::format_Ymd_Hi($grade->created_at)
        ];
    }


}
