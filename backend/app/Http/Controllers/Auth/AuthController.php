<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\MyApp\User\Request\LoginRequest;
use App\MyApp\User\Request\RegisterRequest;
use App\MyApp\User\Services\AuthService;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware('jwtauth', ['except' => ['login', 'register']]);
        $this->authService=$authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->loginAction($request->validated());
    }

    public function register(RegisterRequest $request)
    {
        return $this->authService->registerAction($request->validated());
    }

    public function logout(): JsonResponse
    {
        return $this->authService->logoutAction();
    }

    public function refresh(): JsonResponse
    {
        return $this->authService->refreshAction();
    }




}
