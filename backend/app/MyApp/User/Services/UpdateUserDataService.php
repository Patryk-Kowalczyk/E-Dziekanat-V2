<?php

declare(strict_types=1);

namespace App\MyApp\User\Services;

use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UpdateUserDataService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute($data): JsonResponse
    {
        try {
            $this->userRepository->updateData($data);
            return Response::build([], 200, 'msg/success.update');
        } catch (\Exception $e) {
            Log::error("There was problem with SettingsUserService.updateUserData(): ", ['error' => $e]);
            return Response::build([], 500, 'msg/error.update');
        }
    }
}
