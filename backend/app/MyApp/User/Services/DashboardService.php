<?php

namespace App\Services;

namespace App\MyApp\User\Services;

use App\MyApp\Grade\Repositories\PartialGradeRepository;
use App\MyApp\Plan\Repositories\PlanRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class DashboardService
{
    protected $planRepository;
    protected $partialGradeRepository;
    protected $userRepository;
    protected $fractal;
    protected $tranformsUtil;


    public function __construct(PlanRepository $planRepository,
                                PartialGradeRepository $partialGradeRepository,
                                UserRepository $userRepository,
                                Manager $fractal,
                                TranformsUtil $tranformsUtil)
    {
        $this->planRepository=$planRepository;
        $this->partialGradeRepository=$partialGradeRepository;
        $this->userRepository=$userRepository;
        $this->fractal=$fractal;
        $this->tranformsUtil=$tranformsUtil;
    }

    public function getStudentDashboard(): JsonResponse
    {

        $id=$this->userRepository->getStudentId();

        $studentData = new Item($this->userRepository->getStudentData(),$this->tranformsUtil->getTransformer(0));
        $dayPlanStudent = new Collection($this->planRepository->getCurrentDayPlanStudent($id),$this->tranformsUtil->getTransformer(1));
        $lastGradesStudent = new Collection($this->partialGradeRepository->getLastGradesStudent($id),$this->tranformsUtil->getTransformer(2));
        $avgGradesStudent = $this->partialGradeRepository->getAvgGrades($id);

        $result = ['studentData'=> $this->fractal->createData($studentData),
                'dayPlan'=> $this->fractal->createData($dayPlanStudent),
                'lastGrades'=> $this->fractal->createData($lastGradesStudent),
                'avgGrades'=> $avgGradesStudent
        ];
        return Response::build($result, 200);

    }
}
