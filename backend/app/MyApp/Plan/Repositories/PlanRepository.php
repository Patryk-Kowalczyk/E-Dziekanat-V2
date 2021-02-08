<?php

declare(strict_types=1);

namespace App\MyApp\Plan\Repositories;

use App\Http\Traits\DateFormatTrait;
use App\Models\Plan;
use Carbon\Carbon;


class PlanRepository
{
    protected $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function getCurrentDayPlanStudent($id)
    {
        return $this->getDayPlan($this->currentDay())->where('group_id',$id);
    }

    public function getDay($day)
    {
        return $this->plan
            ->where('date',$day)
            ->orderBy('since')
            ->get();
    }

    public function getWeek($from,$to)
    {
        return $this->plan->whereBetween('date', [$from, $to])->get();
    }




    private function currentDay()
    {
        return DateFormatTrait::format_Ymd(Carbon::now());
    }


}
