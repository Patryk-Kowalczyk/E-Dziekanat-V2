<?php

declare(strict_types=1);

namespace App\MyApp\Grade\Services;

use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class ListPartialGradesForEducatorService
{
    protected $userRepository;
    protected $subjectRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(UserRepository $userRepository, Manager $fractal, TranformsUtil $tranformsUtil, SubjectRepository $subjectRepository)
    {
        $this->userRepository = $userRepository;
        $this->subjectRepository = $subjectRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function execute(): JsonResponse
    {
        try {
            $id = $this->userRepository->getEducatorId();
            $educatorPartialGrades = $this->subjectRepository->getSubjectsForPanelEducator($id);
            $educatorSubjectsWithPartialGradesTransform = new Collection($educatorPartialGrades, $this->tranformsUtil->getTransformer(12));
            $educatorSubjectsWithPartialGradesTransformResponse = $this->fractal->createData($educatorSubjectsWithPartialGradesTransform);
            return Response::build($educatorSubjectsWithPartialGradesTransformResponse, 200,'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with ListPartialGradesForStudentService.execute()", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }
}
