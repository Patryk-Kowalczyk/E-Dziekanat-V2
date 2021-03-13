<?php

namespace App\MyApp\User\Services;

use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class ShowUserDataService
{
    protected $userRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(UserRepository $userRepository, Manager $fractal, TranformsUtil $tranformsUtil)
    {
        $this->userRepository = $userRepository;
        $this->fractal = $fractal;
        $this->tranformsUtil = $tranformsUtil;
    }

    public function execute(): JsonResponse
    {
        $user = $this->userRepository->getUserStatus();
        if ($user->status == "student") {
            $userDataTransform = new Item($this->userRepository->getStudentData(), $this->tranformsUtil->getTransformer(9));
        } elseif ($user->status == "educator") {
            $userDataTransform = new Item($this->userRepository->getEducatorData(), $this->tranformsUtil->getTransformer(10));
        } else {
            return Response::build([], 401, 'msg/error.role');
        }
        return Response::build($this->fractal->createData($userDataTransform), 200);
    }
}
