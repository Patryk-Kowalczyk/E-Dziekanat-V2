<?php

namespace App\MyApp\User\Services;

use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class SettingsUserService
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

    public function showUserData(): JsonResponse
    {
        $user = $this->userRepository->getUserStatus();
        if ($user->status == "student") {
            $userDataTransform = new Item($this->userRepository->getStudentData(), $this->tranformsUtil->getTransformer(9));
        } elseif ($user->status == "educator") {
            $userDataTransform = new Item($this->userRepository->getEducatorData(), $this->tranformsUtil->getTransformer(10));
        } else {
            return Response::build([], 401, 'Undefined status');
        }
        return Response::build($this->fractal->createData($userDataTransform), 200);
    }

    public function updateUserData($data): JsonResponse
    {
        $this->userRepository->updateData($data);
        return Response::build([], 200, 'Udalo sie');
    }

    public function infoSession()
    {
        try {
            $user = $this->userRepository->findOrFailUser();
            return Response::build([
                'name' => $user->first_name,
                'status' => $user->status,
            ], 200, 'Udalo sie');
        } catch (ModelNotFoundException $e) {
            return response([
                'status' => 'Not authorized',
            ], 401);
        }
    }
}
