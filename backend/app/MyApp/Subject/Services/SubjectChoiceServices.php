<?php

namespace App\MyApp\Subject\Services;

use App\MyApp\Subject\Repositories\SubjectChoiceRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;

class SubjectServices
{
    public $userRepository;
    public $subjectChoiceRepository;

    public function __construct(UserRepository $userRepository, SubjectChoiceRepository $subjectChoiceRepository)
    {
        $this->userRepository=$userRepository;
        $this->subjectChoiceRepository=$subjectChoiceRepository;
    }

    public function listOfSubjectToChooseForStudent(): JsonResponse
    {
        $id=$this->userRepository->getStudentId();
        return Response::build($this->subjectChoiceRepository->getAll($id), 200);
    }
            //$final = [];
            //$resultOptions = [];
            //foreach ($this->studentChoices as $studentChoice) {
            //
            //$result['id_question'] = $studentChoice->choice->id;
            //$result['name_question'] = $studentChoice->choice->name;
            //$result['chosen'] = $studentChoice->option_id;
            //$options = Option::where("choice_id", $studentChoice->choice->id)->get();
            //foreach ($options as $option) {
            //
            //$resultOneOption['option_id'] = $option->id;
            //$resultOneOption['option'] = $option->name;
            //$resultOptions[] = $resultOneOption;
            //}
            //$result['answers'] = $resultOptions;
            //$resultOptions = [];
            //$final[] = $result;
            //}
            //return response()->json(['subject_choose' => $final]);


}
