<?php

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\PartialGradeRepository;
use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
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

    public function getAllStudentPartialGrades(): JsonResponse
    {
        $id=$this->userRepository->getStudentId();
        return Response::build($this->subjectRepository->getStudentSubjectsWithPartialGrades($id),200);
    }

    public function getPartialGradesForEducatorPanel():JsonResponse
    {
        $id=$this->userRepository->getEducatorId();
        $educatorPartialGrades= $this->subjectRepository->getSubjectsForPanelEducator($id);
        $educatorSubjectsWithPartialGradesTransform=new Collection($educatorPartialGrades,$this->tranformsUtil->getTransformer(12));
        return Response::build($this->fractal->createData($educatorSubjectsWithPartialGradesTransform), 200);
    }

    public function storePartialGrades($data): JsonResponse
    {
        $studentId = $this->userRepository->getStudentIdByAlbum($data[0]['album']);
        $subject = $this->subjectRepository->find($data[0]['subject_id']);
        $key=1;
        while ($key < count($data)) {
             if($data[$key]['id']=="new") {
                 $this->partialGradeRepository->createGrade($data[$key],$studentId,$subject);
             }else
             {
                 $this->partialGradeRepository->updateGrade($data[$key]);
             }
            $key++;
        }
        return Response::build([], 200,'success');
    }
}
