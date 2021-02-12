<?php

namespace App\MyApp\Poll\Services;


use App\MyApp\Poll\Repositories\PollRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

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
        try {
            $idStudent = $this->userRepository->getStudentId();
            $studentListPollTransform = new Collection($this->pollRepository->getListForStudent($idStudent), $this->tranformsUtil->getTransformer(5));
            $studentListPollTransformResponse=$this->fractal->createData($studentListPollTransform);
            return Response::build($studentListPollTransformResponse, 200,__('msg/success.list'));
        } catch (\Exception $e) {
            Log::error("There was problem with PollServices.getListStudentPolls(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.list'));
        }
    }

    public function showPoll($id): JsonResponse
    {
        try{
        $idStudent = $this->userRepository->getStudentId();
        $pollDetails['status'] = $this->pollRepository->getStatusActivityPollForStudent($id['poll_id'], $idStudent);
        $pollDetails['questionAndAnswers'] = $this->pollRepository->getPollDetails($id['poll_id']);
        return Response::build($pollDetails, 200,__('msg/success.show'));
        } catch (\Exception $e) {
            Log::error("There was problem with PollServices.showPoll(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.show'));
        }
    }

    public function storeAnswersPoll($dataPoll): JsonResponse
    {
        try{
        $idStudent = $this->userRepository->getStudentId();
        foreach ($dataPoll as $answerPoll) {
            $this->pollRepository->updateAnswers($answerPoll, $idStudent);
        }
        return Response::build([], 200, __('msg/success.store'));
        } catch (\Exception $e) {
            Log::error("There was problem with PollServices.storeAnswersPoll(): ", ['error' => $e]);
            return Response::build([], 500, __('msg/error.store'));
        }
    }

}
