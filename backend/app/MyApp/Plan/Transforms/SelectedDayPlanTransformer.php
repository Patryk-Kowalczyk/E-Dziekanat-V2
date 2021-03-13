<?php


namespace App\MyApp\Plan\Transforms;

use App\Models\Plan;
use League\Fractal\TransformerAbstract;

class SelectedDayPlanTransformer extends TransformerAbstract
{
    public function transform(Plan $plan)
    {
        return [
            'name'=> $plan->subjects[0]->name,
            'since' => $plan->since,
            'to' => $plan->to,
            'room' => $plan->room,
            'form' => $plan->subjects[0]->form,
            'group' => $plan->group->name,
            'educator' => $plan->educator->getFullName() ?? null
        ];

    }

}
