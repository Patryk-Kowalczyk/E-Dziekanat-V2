<?php

declare(strict_types=1);

namespace App\MyApp\Plan\Services;

use App\MyApp\Plan\Repositories\PlanRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use League\Fractal\Manager;

class PlanService
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

    final function getPlanByStatus($plan)
    {
        $user = $this->userRepository->getUserData();
        if ($user->status == "student") {
            return $plan->where('group_id', $user->student->group->id);
        } elseif ($user->status == "educator") {
            return $plan->where('educator_id', $user->educator->id);
        } else {
            return Response::build([], 401, 'msg/error.role');
        }
    }
}
