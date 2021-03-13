<?php


namespace App\MyApp\Grade\Transforms;


use App\Http\Traits\DateFormatTrait;
use App\Models\Grade;
use League\Fractal\TransformerAbstract;

class PartialGradeStudentTransformer extends TransformerAbstract
{
    public function transform(Grade $grade): array
    {
        return [
            'category'=>  $grade->category,
            'value'=>  $grade->value,
            'comments'=>  $grade->comments,
            'date' => DateFormatTrait::format_Ymd($grade->created_at)
        ];
    }


}
