<?php


namespace App\MyApp\User\Services;

use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;

class InfoUserLoggedService
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
        try {
            $user = $this->userRepository->findOrFailUser();
            return Response::build([
                'name' => $user->first_name,
                'status' => $user->status,
            ], 200, 'msg/success.role');
        } catch (ModelNotFoundException $e) {
            return Response::build([], 401, 'msg/error.role');
        }
    }

}
