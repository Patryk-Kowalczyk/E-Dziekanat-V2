<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\MyApp\Poll\Requests\ShowPollByIdRequest;
use App\MyApp\Poll\Requests\StoreAnswersRequest;
use App\MyApp\Poll\Services\ListPollsService;
use App\MyApp\Poll\Services\ShowPollService;
use App\MyApp\Poll\Services\StoreAnswersPollService;
use Illuminate\Http\JsonResponse;

class PollController extends Controller
{
    protected $listPollsService;
    protected $showPollService;
    protected $storeAnswersPollService;

    public function __construct(ListPollsService $listPollsService,
                                ShowPollService $showPollService,
                                StoreAnswersPollService $storeAnswersPollService)
    {
        $this->middleware('auth:api');
        $this->listPollsService = $listPollsService;
        $this->showPollService = $showPollService;
        $this->storeAnswersPollService = $storeAnswersPollService;
    }

    public function list(): JsonResponse
    {
        return $this->listPollsService->execute();
    }

    public function show(ShowPollByIdRequest $request): JsonResponse
    {
        return $this->showPollService->execute($request->validated());
    }

    public function store(StoreAnswersRequest $request): JsonResponse
    {
        return $this->storeAnswersPollService->execute($request->validated());
    }
}
