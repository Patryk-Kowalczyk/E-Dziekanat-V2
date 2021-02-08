<?php

namespace App\MyApp\Subject\Services;

use App\MyApp\Subject\Repositories\SubjectChoiceRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class SubjectChoiceServices
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

    public function listOfSubjectToChooseForStudent(): JsonResponse
    {
        $id = $this->userRepository->getStudentId();
        $studentChoiceList = $this->subjectChoiceRepository->getAllStudentChoiceList($id)->toArray();
        $index = 0;
        foreach ($studentChoiceList as $record) {
            $subjectList = $this->subjectChoiceRepository->getChoiceOptionsSubject($record['choice_id']);
            $subjectList = new Collection($subjectList, $this->tranformsUtil->getTransformer(6));
            $record['answer'] = $this->fractal->createData($subjectList);
            $studentChoiceList[$index++] = $record;
        }
        return Response::build($studentChoiceList, 200);
    }

    public function storeSubjectChoiceStudent($data)
    {
        $idStudent = $this->userRepository->getStudentId();
        foreach ($data as $choiceSubject) {
            $this->subjectChoiceRepository->updateChoiceSubjectByStudent($choiceSubject, $idStudent);
        }
        return Response::build([],200, "Pomyślnie umieszczono");
    }
}
