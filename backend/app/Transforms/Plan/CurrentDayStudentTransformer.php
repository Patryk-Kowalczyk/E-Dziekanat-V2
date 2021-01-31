<?php


namespace App\Transforms\Plan;

use App\Models\Plan;
use League\Fractal\TransformerAbstract;

class CurrentDayStudentTransformer extends TransformerAbstract
{
    public function transform(Plan $plan)
    {
        return [
            'name'=> $plan->subjects[0]->name,
            'since' => $plan->since,
            'to' => $plan->to,
            'room' => $plan->room,
            'form' => $plan->subjects[0]->form,
            'educator' => $plan->educator->getFullName()
        ];

    }

}
