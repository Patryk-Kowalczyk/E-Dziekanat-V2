<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\MyApp\Message\Request\ShowByIdMessageRequest;
use App\MyApp\Message\Services\ListMessagesService;
use App\MyApp\Message\Services\ShowMessageService;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    protected $listMessagesService;
    protected $showMessageService;

    public function __construct(ListMessagesService $listMessagesService,
                                ShowMessageService $showMessageService
    )
    {
        $this->middleware('auth:api');
        $this->listMessagesService = $listMessagesService;
        $this->showMessageService = $showMessageService;
    }

    public function index(): JsonResponse
    {
        return $this->listMessagesService->execute();
    }

    public function show(ShowByIdMessageRequest $request): JsonResponse
    {
        return $this->showMessageService->execute($request->validated());
    }
}
