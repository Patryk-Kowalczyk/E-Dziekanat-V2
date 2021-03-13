<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\MyApp\Plan\Request\DayPlanRequest;
use App\MyApp\Plan\Request\WeekPlanRequest;
use App\MyApp\Plan\Services\DayPlanService;
use App\MyApp\Plan\Services\WeekPlanService;
use Illuminate\Http\JsonResponse;

class PlanController extends Controller
{
    protected $dayPlanService;
    protected $weekPlanService;

    public function __construct(DayPlanService $dayPlanService, WeekPlanService $weekPlanService)
    {
        $this->middleware('auth:api');
        $this->dayPlanService = $dayPlanService;
        $this->weekPlanService = $weekPlanService;
    }

    public function weekIndex(WeekPlanRequest $request): JsonResponse
    {
        return $this->weekPlanService->execute($request->validated());
    }

    public function dayIndex(DayPlanRequest $request): JsonResponse
    {
        return $this->dayPlanService->execute($request->validated());
    }
}
