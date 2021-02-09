<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyApp\User\Request\UpdateDataUserRequest;
use App\MyApp\User\Services\SettingsUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class PersonDataController extends Controller
{
    protected $settingsUserService;
    public function __construct(SettingsUserService $settingsUserService)
    {
        $this->middleware('auth:api',['except' => 'info']);
        $this->settingsUserService=$settingsUserService;
    }

    public function info()
    {
        return $this->settingsUserService->infoSession();
    }

    public function index(): JsonResponse
    {
        return $this->settingsUserService->showUserData();
    }

    public function update(UpdateDataUserRequest $request): JsonResponse
    {
        return $this->settingsUserService->updateUserData($request->validated());
    }

}
