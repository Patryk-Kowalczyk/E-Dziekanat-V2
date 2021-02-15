<?php

declare(strict_types=1);

namespace App\MyApp\User\Services;

use App\MyApp\Grade\Repositories\PartialGradeRepository;
use App\MyApp\Meeting\Repositories\MeetingRepository;
use App\MyApp\Plan\Repositories\PlanRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ShowUserDashboardService
{
    protected $planRepository;
    protected $partialGradeRepository;
    protected $userRepository;
    protected $meetingRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(PlanRepository $planRepository,
                                PartialGradeRepository $partialGradeRepository,
                                UserRepository $userRepository,
                                MeetingRepository $meetingRepository,
                                Manager $fractal,
                                TranformsUtil $tranformsUtil)
    {
        $this->planRepository = $planRepository;
        $this->meetingRepository = $meetingRepository;
        $this->partialGradeRepository = $partialGradeRepository;
        $this->userRepository = $userRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function execute(): JsonResponse
    {
        try {
            $user = $this->userRepository->getUserStatus();
            if ($user->status == "student") {
                $result=$this->getStudentDashboard();
            } elseif ($status = "educator") {
                $result=$this->getEducatorDashboard();
            } else {
                return Response::build([], 500, 'msg/error.list');
            }
            return Response::build($result, 200, 'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with ShowUserDashboard.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }

    private function getStudentDashboard(): array
    {
        $id = $this->userRepository->getStudentId();
        $studentData = new Item($this->userRepository->getStudentData(), $this->tranformsUtil->getTransformer(9));
        $dayPlanStudent = new Collection($this->planRepository->getCurrentDayPlanStudent($id), $this->tranformsUtil->getTransformer(1));
        $lastGradesStudent = new Collection($this->partialGradeRepository->getLastGradesStudent($id), $this->tranformsUtil->getTransformer(2));
        $avgGradesStudent = $this->partialGradeRepository->getAvgGrades($id);
        return ['studentData' => $this->fractal->createData($studentData),
            'dayPlan' => $this->fractal->createData($dayPlanStudent),
            'lastGrades' => $this->fractal->createData($lastGradesStudent),
            'avgGrades' => $avgGradesStudent
        ];
    }

    private function getEducatorDashboard(): array
    {
        $id = $this->userRepository->getEducatorId();
        $educatorData = new Item($this->userRepository->getEducatorData(), $this->tranformsUtil->getTransformer(10));
        $dayPlanEducator = new Collection($this->planRepository->getCurrentDayPlanEducator($id), $this->tranformsUtil->getTransformer(1));
        $meetings = $this->meetingRepository->getEducatorMeetings($id);
        return ['educatorData' => $this->fractal->createData($educatorData),
            'dayPlan' => $this->fractal->createData($dayPlanEducator),
            'meetings' => $meetings,
        ];
    }

}
