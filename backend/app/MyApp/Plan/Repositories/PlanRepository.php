<?php

declare(strict_types=1);

namespace App\MyApp\Plan\Repositories;

use App\Http\Traits\DateFormatTrait;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;


class PlanRepository
{
    protected $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function getCurrentDayPlanStudent($id): Collection
    {
        return $this->getDay($this->currentDay())->where('group_id', $id);
    }

    public function getCurrentDayPlanEducator($id): Collection
    {
        return $this->getDay($this->currentDay())->where('educator_id', $id);
    }

    public function getDay($day): Collection
    {
        return $this->plan
            ->where('date', $day)
            ->orderBy('since')
            ->get();
    }

    public function getWeek($from, $to): Collection
    {
        return $this->plan->whereBetween('date', [$from, $to])->orderBy('since')->get();
    }

    private function currentDay(): string
    {
        return DateFormatTrait::format_Ymd(Carbon::now());
    }
}
