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
use League\Fractal\Resource\Collection;

class ListPollsService
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
            $idStudent = $this->userRepository->getStudentId();
            $studentListPollTransform = new Collection($this->pollRepository->getListForStudent($idStudent), $this->tranformsUtil->getTransformer(5));
            $studentListPollTransformResponse = $this->fractal->createData($studentListPollTransform);
            return Response::build($studentListPollTransformResponse, 200, 'msg/success.list');
        } catch (\Exception $e) {
            Log::error("There was problem with ListPollsService.execute(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.list');
        }
    }
}
