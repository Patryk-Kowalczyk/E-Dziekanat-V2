<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\MyApp\User\Request\UpdateDataUserRequest;
use App\MyApp\User\Services\InfoUserLoggedService;
use App\MyApp\User\Services\SettingsUserService;
use App\MyApp\User\Services\ShowUserDataService;
use App\MyApp\User\Services\UpdateUserDataService;
use Illuminate\Http\JsonResponse;

class UserDataController extends Controller
{
    protected $infoUserLoggedService;
    protected $showUserDataService;
    protected $updateUserDataService;

    public function __construct(InfoUserLoggedService $infoUserLoggedService,
                                ShowUserDataService $showUserDataService,
                                UpdateUserDataService $updateUserDataService)
    {
        $this->middleware('auth:api', ['except' => 'info']);
        $this->infoUserLoggedService = $infoUserLoggedService;
        $this->showUserDataService = $showUserDataService;
        $this->updateUserDataService = $updateUserDataService;
    }

    public function info(): JsonResponse
    {
        return $this->infoUserLoggedService->execute();
    }

    public function index(): JsonResponse
    {
        return $this->showUserDataService->execute();
    }

    public function update(UpdateDataUserRequest $request): JsonResponse
    {
        return $this->updateUserDataService->execute($request->validated());
    }
}
