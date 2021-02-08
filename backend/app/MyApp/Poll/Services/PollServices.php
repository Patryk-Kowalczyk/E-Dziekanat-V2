<?php

namespace App\MyApp\Poll\Services;


use App\MyApp\Poll\Repositories\PollRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Psy\Util\Json;

class PollServices
{
    protected $pollRepository;
    protected $userRepository;
    protected $fractal;
    protected $tranformsUtil;


    public function __construct(UserRepository $userRepository, PollRepository $pollRepository, Manager $fractal, TranformsUtil $tranformsUtil)
    {
        $this->userRepository = $userRepository;
        $this->pollRepository = $pollRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function getListStudentPolls(): JsonResponse
    {
        $idStudent = $this->userRepository->getStudentId();
        $studentListPoll = new Collection($this->pollRepository->getListForStudent($idStudent), $this->tranformsUtil->getTransformer(5));

        return Response::build($this->fractal->createData($studentListPoll), 200);
    }

    public function showPoll($id): JsonResponse
    {

        $idStudent = $this->userRepository->getStudentId();
        $pollDetails['status'] = $this->pollRepository->getStatusActivityPollForStudent($id['poll_id'], $idStudent);
        $pollDetails['questionAndAnswers'] = $this->pollRepository->getPollDetails($id['poll_id']);
        return Response::build($pollDetails, 200);
    }

    public function storeAnswersPoll($dataPoll): JsonResponse
    {
        $idStudent = $this->userRepository->getStudentId();
        foreach ($dataPoll as $answerPoll) {
            $this->pollRepository->updateAnswers($answerPoll, $idStudent);
        }
        return Response::build([],200, "Pomyślnie umieszczono");
    }

}
