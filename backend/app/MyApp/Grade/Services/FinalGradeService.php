<?php

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\FinalGradeRepository;
use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class FinalGradeService
{
    protected $userRepository;
    protected $finalGradeRepository;
    protected $subjectRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(UserRepository $userRepository,
                                FinalGradeRepository $finalGradeRepository,
                                SubjectRepository $subjectRepository,
                                Manager $fractal,
                                TranformsUtil $tranformsUtil)
    {
        $this->userRepository=$userRepository;
        $this->finalGradeRepository=$finalGradeRepository;
        $this->subjectRepository=$subjectRepository;
        $this->fractal=$fractal;
        $this->tranformsUtil=$tranformsUtil;
    }

    public function getAllStudentFinalGrades(): object
    {
        $id=$this->userRepository->getStudentId();
        $finalGrades = new Collection($this->finalGradeRepository->getByStudentId($id),$this->tranformsUtil->getTransformer(3));
        return Response::build($this->fractal->createData($finalGrades), 200);
    }

    public function getFinalGradesForEducatorPanel(): JsonResponse
    {
        $id=$this->userRepository->getEducatorId();
        $educatorFinalGrades= $this->subjectRepository->getSubjectsForPanelEducator($id);
        $educatorSubjectsWithFinalGradesTransform=new Collection($educatorFinalGrades,$this->tranformsUtil->getTransformer(11));
        return Response::build($this->fractal->createData($educatorSubjectsWithFinalGradesTransform), 200);
    }

    public function updateFinalGrades($data): JsonResponse
    {
        $this->finalGradeRepository->updateFinalGrade($data);
        return Response::build([], 200,'success');
    }



}
