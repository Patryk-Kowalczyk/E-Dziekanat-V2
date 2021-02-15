<?php

declare(strict_types=1);

namespace App\MyApp\Grade\Services;

use App\MyApp\Grade\Repositories\PartialGradeRepository;
use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;

class StorePartialGradesService
{
    protected $userRepository;
    protected $partialGradeRepository;
    protected $subjectRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(UserRepository $userRepository, PartialGradeRepository $partialGradeRepository, Manager $fractal, TranformsUtil $tranformsUtil, SubjectRepository $subjectRepository)
    {
        $this->userRepository = $userRepository;
        $this->partialGradeRepository = $partialGradeRepository;
        $this->subjectRepository = $subjectRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function execute($data): JsonResponse
    {
        try {
            $studentId = $this->userRepository->getStudentIdByAlbum($data[0]['album']);
            $subject = $this->subjectRepository->find($data[0]['subject_id']);
            $key = 1;
            while ($key < count($data)) {
                if ($data[$key]['id'] == "new") {
                    $this->partialGradeRepository->createGrade($data[$key], $studentId, $subject);
                } else {
                    $this->partialGradeRepository->updateGrade($data[$key]);
                }
                $key++;
            }
            return Response::build([], 200, 'msg/success.store');
        } catch (\Exception $e) {
            Log::error("There was problem with StorePartialGradesService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.store');
        }
    }
}
