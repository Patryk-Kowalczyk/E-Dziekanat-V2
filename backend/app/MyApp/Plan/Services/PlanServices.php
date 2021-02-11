<?php

namespace App\MyApp\Plan\Services;

use App\Http\Traits\DaysFormatTrait;
use App\MyApp\Plan\Repositories\PlanRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
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
        $plan = $this->planRepository->getDay($data['dateOfDay']);
        $planUser = $this->getPlanByStatus($plan);
        $planTransform = new Collection($planUser, $this->tranformsUtil->getTransformer(1));
        return Response::build($this->fractal->createData($planTransform), 200);
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

    public function getWeekPlan($data): JsonResponse
    {

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

        return Response::build($planWeek, 200);
    }



}
