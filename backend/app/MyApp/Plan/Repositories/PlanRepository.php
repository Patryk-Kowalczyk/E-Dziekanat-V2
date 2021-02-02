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
        return $this->plan
            ->where('date', $this->currentDay())
            ->where('group_id',$id)
            ->get();
    }

    public function getCurrentDayPlanEducator($id)
    {
        return $this->plan
            ->where('date', $this->currentDay())
            ->where('educator_id',$id)
            ->get();
    }

    private function currentDay()
    {
        return DateFormatTrait::format_Ymd(Carbon::now());
    }


}
