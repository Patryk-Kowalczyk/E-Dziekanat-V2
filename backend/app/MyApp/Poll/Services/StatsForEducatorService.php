<?php

declare(strict_types=1);

namespace App\MyApp\Poll\Services;

use App\MyApp\Poll\Repositories\PollRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use League\Fractal\Manager;

class StatsForEducatorService
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

    public function execute(): JsonResponse
    {
        try {
            $questionsPoll = $this->pollRepository->getPollQuestions(2);
            foreach ($questionsPoll as $question) {
                $countPoll['name'] = $question->name;
                $countPoll['answers'] = $this->pollRepository->getCountAnswers($question->id);
                $statsPoll[] = $countPoll;
            }
            return Response::build($statsPoll, 200, 'msg/success.show');
        } catch (\Exception $e) {
            Log::error("There was problem with StatsForEducatorService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.show');
        }
    }
}
