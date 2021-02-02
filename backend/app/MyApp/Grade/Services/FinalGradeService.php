<?php

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\FinalGradeRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\TranformsUtil;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class FinalGradeService
{
    protected $userRepository;
    protected $finalGradeRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(UserRepository $userRepository, FinalGradeRepository $finalGradeRepository, Manager $fractal, TranformsUtil $tranformsUtil)
    {
        $this->userRepository=$userRepository;
        $this->finalGradeRepository=$finalGradeRepository;
        $this->fractal=$fractal;
        $this->tranformsUtil=$tranformsUtil;
    }

    public function getAllStudentFinalGrades(): object
    {
        $id=$this->userRepository->getStudentId();
        $finalGrades = new Collection($this->finalGradeRepository->getByStudentId($id),$this->tranformsUtil->getTransformer(3));
        return $this->fractal->createData($finalGrades);
    }



}
