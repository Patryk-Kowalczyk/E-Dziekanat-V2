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

class ShowPollService
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

    public function execute($id): JsonResponse
    {
        try{
            $idStudent = $this->userRepository->getStudentId();
            $pollDetails['status'] = $this->pollRepository->getStatusActivityPollForStudent($id['poll_id'], $idStudent);
            $pollDetails['questionAndAnswers'] = $this->pollRepository->getPollDetails($id['poll_id']);
            return Response::build($pollDetails, 200,'msg/success.show');
        } catch (\Exception $e) {
            Log::error("There was problem with ShowPollService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.show');
        }
    }
}
