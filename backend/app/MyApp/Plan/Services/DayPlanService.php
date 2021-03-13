<?php

declare(strict_types=1);

namespace App\MyApp\Plan\Services;

use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Resource\Collection;

class DayPlanService extends PlanService
{
    public function execute($data): JsonResponse
    {
        try {
            $plan = $this->planRepository->getDay($data['dateOfDay']);
            $planUser = $this->getPlanByStatus($plan);
            $planTransform = new Collection($planUser, $this->tranformsUtil->getTransformer(1));
            $planTransformResponse = $this->fractal->createData($planTransform);
            return Response::build($planTransformResponse, 200, 'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with DayPlanService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }
}
