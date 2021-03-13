<?php

declare(strict_types=1);

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

class ListFinalGradeForStudentService
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

    public function execute(): JsonResponse
    {
        try {
            $id = $this->userRepository->getEducatorId();
            $educatorFinalGrades = $this->subjectRepository->getSubjectsForPanelEducator($id);
            $educatorSubjectsWithFinalGradesTransform = new Collection($educatorFinalGrades, $this->tranformsUtil->getTransformer(11));
            $educatorSubjectsWithFinalGradesTransform = $this->fractal->createData($educatorSubjectsWithFinalGradesTransform);
            return Response::build($educatorSubjectsWithFinalGradesTransform, 200, 'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with ListFinalGradeForStudentService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }
}
