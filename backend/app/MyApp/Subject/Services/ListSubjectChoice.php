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
use League\Fractal\Resource\Collection;

class ListSubjectChoice
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

    public function execute(): JsonResponse
    {
        try {
            $id = $this->userRepository->getStudentId();
            $studentChoiceList = $this->subjectChoiceRepository->getAllStudentChoiceList($id)->toArray();
            $index = 0;
            foreach ($studentChoiceList as $record) {
                $subjectList = $this->subjectChoiceRepository->getChoiceOptionsSubject($record['choice_id']);
                $subjectList = new Collection($subjectList, $this->tranformsUtil->getTransformer(6));
                $record['answer'] = $this->fractal->createData($subjectList);
                $studentChoiceList[$index++] = $record;
            }
            return Response::build($studentChoiceList, 200, __('msg/success.list'));
        } catch (\Exception $e) {
            Log::error("There was problem with ListSubjectChoice.execute(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

}
