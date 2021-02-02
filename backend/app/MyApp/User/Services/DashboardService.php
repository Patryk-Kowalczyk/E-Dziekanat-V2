<?php

namespace App\Services;

namespace App\MyApp\User\Services;

use App\MyApp\Grade\Repositories\PartialGradeRepository;
use App\MyApp\Plan\Repositories\PlanRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\TranformsUtil;
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

    public function getStudentDashboard(): array
    {

        $id=$this->userRepository->getStudentId();

        $studentData = new Item($this->userRepository->getStudentData(),$this->tranformsUtil->getTransformer(0));
        $dayPlanStudent = new Collection($this->planRepository->getCurrentDayPlanStudent($id),$this->tranformsUtil->getTransformer(1));
        $lastGradesStudent = new Collection($this->partialGradeRepository->getLastGradesStudent($id),$this->tranformsUtil->getTransformer(2));
        $avgGradesStudent = $this->partialGradeRepository->getAvgGrades($id);

        return ['student_data'=> $this->fractal->createData($studentData),
                'day_plan'=> $this->fractal->createData($dayPlanStudent),
                'last_grades'=> $this->fractal->createData($lastGradesStudent),
                'avg_grades'=> $avgGradesStudent
        ];

    }
}
