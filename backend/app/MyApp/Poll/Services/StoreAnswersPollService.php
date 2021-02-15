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

class StoreAnswersPollService
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

    public function execute($dataPoll): JsonResponse
    {
        try {
            $idStudent = $this->userRepository->getStudentId();
            foreach ($dataPoll as $answerPoll) {
                $this->pollRepository->updateAnswers($answerPoll, $idStudent);
            }
            return Response::build([], 200, 'msg/success.store');
        } catch (\Exception $e) {
            Log::error("There was problem with StoreAnswersPollService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.store');
        }
    }
}
