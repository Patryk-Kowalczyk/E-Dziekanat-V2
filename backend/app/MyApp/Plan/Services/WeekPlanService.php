<?php

declare(strict_types=1);

namespace App\MyApp\Plan\Services;

use App\Http\Traits\DaysFormatTrait;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Resource\Item;

class WeekPlanService extends PlanService
{
    public function execute($data): JsonResponse
    {
        try {
            $from = $data['dateStart'];
            $to = $data['dateEnd'];
            $plan = $this->planRepository->getWeek($from, $to);
            $planUser = $this->getPlanByStatus($plan);
            $formatAllDays = DaysFormatTrait::weekFormat($from, $to);
            foreach ($formatAllDays as $dayCurrent) {
                foreach ($planUser as $lesson) {
                    if ($dayCurrent == $lesson->date) {
                        $planTransform = new Item($lesson, $this->tranformsUtil->getTransformer(1));
                        $planTransform = $this->fractal->createData($planTransform);
                        $resultForDay[] = $planTransform;
                    }
                }
                $planWeek[$dayCurrent] = $resultForDay;
                $resultForDay = [];
            }
            return Response::build($planWeek, 200, 'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with WeekPlanService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }
}
