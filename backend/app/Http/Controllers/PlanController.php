<?php

namespace App\Http\Controllers;

use App\MyApp\Plan\Request\DayPlanRequest;
use App\MyApp\Plan\Request\WeekPlanRequest;
use App\MyApp\Plan\Services\PlanServices;
use Illuminate\Http\JsonResponse;


class PlanController extends Controller
{
    protected $planServices;

    public function __construct(PlanServices $planServices)
    {
        $this->middleware('auth:api');
        $this->planServices=$planServices;
    }

    public function weekIndex(WeekPlanRequest $request): JsonResponse
    {
        return $this->planServices->getWeekPlan($request->validated());
    }

    public function dayIndex(DayPlanRequest $request):JsonResponse
    {
        return $this->planServices->getDayPlan($request->validated());
    }


}
