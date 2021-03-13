<?php

declare(strict_types=1);

namespace App\MyApp\Subject\Services;

use App\MyApp\Subject\Repositories\SubjectChoiceRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;

class StoreSubjectChoice
{
    public $userRepository;
    public $subjectChoiceRepository;
    public $tranformsUtil;
    public $fractal;

    public function __construct(UserRepository $userRepository, SubjectChoiceRepository $subjectChoiceRepository, TranformsUtil $tranformsUtil, Manager $fractal)
    {
        $this->userRepository = $userRepository;
        $this->subjectChoiceRepository = $subjectChoiceRepository;
        $this->tranformsUtil = $tranformsUtil;
        $this->fractal = $fractal;
    }

    public function execute($data): JsonResponse
    {
        try {
            $idStudent = $this->userRepository->getStudentId();
            foreach ($data as $choiceSubject) {
                $this->subjectChoiceRepository->updateChoiceSubjectByStudent($choiceSubject, $idStudent);
            }
            return Response::build([], 200, 'msg/success.store');
        } catch (\Exception $e) {
            Log::error("There was problem with StoreSubjectChoice.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.store');
        }
    }
}
