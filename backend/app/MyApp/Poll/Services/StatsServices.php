<?php

namespace App\MyApp\Poll\Services;

use App\MyApp\Poll\Repositories\PollRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;

class StatsServices
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

    public function getStatsPoll(): JsonResponse
    {
        $questionsPoll= $this->pollRepository->getPollQuestions(2);
        foreach($questionsPoll as $question)
        {
            $countPoll['name'] = $question->name;
            $countPoll['answers'] = $this->pollRepository->getCountAnswers($question->id);
            $result[]=$countPoll;
        }
        return Response::build($result, 200);
    }
}
