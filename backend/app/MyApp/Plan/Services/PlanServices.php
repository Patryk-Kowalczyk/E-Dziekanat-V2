<?php

namespace App\MyApp\Plan\Services;

use App\Http\Traits\DaysFormatTrait;
use App\MyApp\Plan\Repositories\PlanRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Illuminate\Database\Eloquent;
use League\Fractal\Resource\Item;

class PlanServices
{
    protected $fractal;
    protected $tranformsUtil;
    protected $userRepository;
    protected $planRepository;

    public function __construct(UserRepository $userRepository, PlanRepository $planRepository, Manager $fractal, TranformsUtil $tranformsUtil)
    {
        $this->userRepository = $userRepository;
        $this->planRepository = $planRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function getDayPlan($data): JsonResponse
    {
        try {
            $plan = $this->planRepository->getDay($data['dateOfDay']);
            $planUser = $this->getPlanByStatus($plan);
            $planTransform = new Collection($planUser, $this->tranformsUtil->getTransformer(1));
            $planTransformResponse = $this->fractal->createData($planTransform);
            return Response::build($planTransformResponse, 200, __('msg/success.list'));
        } catch (\Exception $e) {
            Log::error("There was problem with PlanServices.getDayPlan(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

    public function getWeekPlan($data): JsonResponse
    {
        try {
            $from = $data['dateStart'];
            $to = $data['dateEnd'];
            $allPlan = $this->planRepository->getWeek($from, $to);
            $planUser = $this->getPlanByStatus($allPlan);
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
            return Response::build($planWeek, 200, __('msg/success.list'));
        } catch (\Exception $e) {
            Log::error("There was problem with PlanServices.getWeekPlan(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

    private function getPlanByStatus($plan)
    {
        $user = $this->userRepository->getUserData();
        if ($user->status == "student") {
            return $plan->where('group_id', $user->student->group->id);
        } elseif ($user->status == "educator") {
            return $plan->where('educator_id', $user->educator->id);
        } else {
            return Response::build([], 401, "Undefined status");
        }
    }


}
