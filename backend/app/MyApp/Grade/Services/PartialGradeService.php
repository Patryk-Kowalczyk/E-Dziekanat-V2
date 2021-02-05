<?php

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\PartialGradeRepository;
use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class PartialGradeService
{
    protected $userRepository;
    protected $partialGradeRepository;
    protected $subjectRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(UserRepository $userRepository, PartialGradeRepository $partialGradeRepository, Manager $fractal, TranformsUtil $tranformsUtil, SubjectRepository $subjectRepository)
    {
        $this->userRepository=$userRepository;
        $this->partialGradeRepository=$partialGradeRepository;
        $this->subjectRepository=$subjectRepository;
        $this->fractal=$fractal;
        $this->tranformsUtil=$tranformsUtil;
    }

    public function getAllStudentPartialGrades(): object
    {
        $id=$this->userRepository->getStudentId();
        return Response::build($this->subjectRepository->getStudentSubjectsWithPartialGrades($id),200);
    }
}
