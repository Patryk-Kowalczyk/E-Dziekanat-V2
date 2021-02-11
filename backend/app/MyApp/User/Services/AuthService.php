<?php

namespace App\MyApp\User\Services;

use App\Models\User;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use League\Fractal\Manager;


class AuthService
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
    public function loginAction($data): JsonResponse
    {
        if (!$token = auth()->attempt($data)) {
            return Response::build([], 401,'Unauthorized');
        }
        return $this->createNewToken($token);
    }

    public function registerAction($data): JsonResponse
    {
        $user = User::create(array_merge(
            $data,
            ['password' => bcrypt($data['password'])]
        ));
        return Response::build([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function logoutAction():JsonResponse
    {
        auth()->logout();
        return Response::build([],200,'success');
    }

    public function refreshAction(): JsonResponse
    {
        return $this->createNewToken(auth()->refresh());
    }

    protected function createNewToken($token): JsonResponse
    {
        return Response::build([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
        ],200);
    }

}
