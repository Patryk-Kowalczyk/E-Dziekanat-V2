<?php


namespace App\MyApp\Poll\Transforms;


use App\Http\Traits\DateFormatTrait;
use App\Models\PollModels\Pollstudent;

use League\Fractal\TransformerAbstract;

class PollListTransformer extends TransformerAbstract
{
    public function transform(Pollstudent $pollStudent): array
    {
        return [
            'poll_id'=>  $pollStudent->poll_id,
            'poll_name'=>  $pollStudent->pollname->name,
            'since'=>  $pollStudent->pollname->since,
            'to'=>  $pollStudent->pollname->to,
            'status'=>  $pollStudent->status,
        ];
    }


}
