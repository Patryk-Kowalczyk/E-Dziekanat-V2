<?php

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\FinalGradeRepository;
use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
        $this->userRepository = $userRepository;
        $this->finalGradeRepository = $finalGradeRepository;
        $this->subjectRepository = $subjectRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function getAllStudentFinalGrades(): object
    {
        try {
            $id = $this->userRepository->getStudentId();
            $finalGrades = new Collection($this->finalGradeRepository->getByStudentId($id), $this->tranformsUtil->getTransformer(3));
            $finalGrades = $this->fractal->createData($finalGrades);
            return Response::build($finalGrades, 200, __(__('msg/success.list')));
        } catch (\Exception $e) {
            Log::error("There was problem with FinalGradeService.getAllStudentFinalGrades(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

    public function getFinalGradesForEducatorPanel(): JsonResponse
    {
        try {
            $id = $this->userRepository->getEducatorId();
            $educatorFinalGrades = $this->subjectRepository->getSubjectsForPanelEducator($id);
            $educatorSubjectsWithFinalGradesTransform = new Collection($educatorFinalGrades, $this->tranformsUtil->getTransformer(11));
            $educatorSubjectsWithFinalGradesTransform = $this->fractal->createData($educatorSubjectsWithFinalGradesTransform);
            return Response::build($educatorSubjectsWithFinalGradesTransform, 200, __('msg/success.list'));
        } catch (\Exception $e) {
            Log::error("There was problem with FinalGradeService.getFinalGradesForEducatorPanel(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

    public function updateFinalGrades($data): JsonResponse
    {
        try {
            $this->finalGradeRepository->updateFinalGrade($data);
            return Response::build([], 200, __('msg/success.update'));
        } catch (\Exception $e) {
            Log::error("There was problem with FinalGradeService.updateFinalGrades(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.update'));
        }
    }


}
