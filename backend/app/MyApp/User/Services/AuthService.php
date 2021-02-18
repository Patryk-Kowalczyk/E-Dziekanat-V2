<?php

declare(strict_types=1);

namespace App\MyApp\User\Services;

use App\Models\User;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use App\MyApp\Utility\TranformsUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
        if ($token = auth()->attempt($data)) {
            $newToken = $this->createNewToken($token);
            return Response::build($newToken, 401, 'msg/success.login');
        } else {
            Log::error("There was problem with AuthService.loginAction(): ");
            return Response::build([], 500, 'msg/error.login');
        }
    }

    public function registerAction($data): JsonResponse
    {
        try {
            $user = User::create(array_merge(
                $data,
                ['password' => bcrypt($data['password'])]
            ));
            return Response::build([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201, 'msg/success.create');
        } catch (\Exception $e) {
            Log::error("There was problem with AuthService.registerAction(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.create');
        }
    }

    public function logoutAction(): JsonResponse
    {
        auth()->logout();
        return Response::build([], 200, 'msg/success.logout');
    }

    public function refreshAction(): JsonResponse
    {
        $refreshToken = $this->createNewToken(auth()->refresh());
        return Response::build($refreshToken, 200, 'msg/success.refresh');
    }

    protected function createNewToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
        ];
    }
}
