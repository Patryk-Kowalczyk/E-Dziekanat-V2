<?php

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\PartialGradeRepository;
use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
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
//        $partialGrades = Subject::with(['grades' => function ($q) {
//            $q->select(
//                ['grades.category', 'grades.value', 'grades.comments', 'grades.created_at as date']
//            )->where('grades.student_id', $this->student->id);
//        }])->where('subjects.form', '!=', 'OK')->get();




        $id=$this->userRepository->getStudentId();
        $subject = new Collection($this->subjectRepository->getAll(),$this->tranformsUtil->getTransformer(4));


        return $this->fractal->createData($subject);

        $partialGrades = new Collection($this->partialGradeRepository->getAllStudentGrades($id),$this->tranformsUtil->getTransformer(2));
        return $this->fractal->createData($partialGrades);
    }



}
