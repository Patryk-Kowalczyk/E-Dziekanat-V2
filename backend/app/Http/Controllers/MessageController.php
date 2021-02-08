<?php

namespace App\Http\Controllers;

use App\MyApp\Message\Request\ShowByIdMessageRequest;
use App\MyApp\Message\Services\MessageService;
use Illuminate\Http\JsonResponse;


class MessageController extends Controller
{
    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->middleware('auth:api');
        $this->messageService=$messageService;
    }

    public function index(): JsonResponse
    {
        return $this->messageService->getMessages();
    }

    public function show(ShowByIdMessageRequest $request):JsonResponse
    {
        return $this->messageService->getMessageDetails($request->validated());
    }

}
