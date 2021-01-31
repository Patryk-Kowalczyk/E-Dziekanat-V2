<?php

namespace App\Services;

use App\Repositories\PartialGradeRepository;
use App\Repositories\PlanRepository;
use App\Repositories\UserRepository;
use App\Transforms\TranformsUtil;
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

    public function getStudentDashboard()
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
