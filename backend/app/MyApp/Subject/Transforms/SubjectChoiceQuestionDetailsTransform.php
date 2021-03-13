<?php


namespace App\MyApp\Subject\Transforms;


use App\Models\SelectSubjectModels\Option;

use League\Fractal\TransformerAbstract;

class SubjectChoiceQuestionDetailsTransform extends TransformerAbstract
{

    public function transform(Option $option): array
    {
        return [
            'option_id' => $option->id,
            'option' => $option->name,
        ];
    }
}
