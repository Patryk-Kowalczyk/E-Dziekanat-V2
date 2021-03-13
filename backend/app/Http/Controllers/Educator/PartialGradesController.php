<?php

declare(strict_types=1);

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\MyApp\Grade\Request\StorePartialGradeRequest;
use App\MyApp\Grade\Services\ListPartialGradesForEducatorService;
use App\MyApp\Grade\Services\StorePartialGradesService;
use Illuminate\Http\JsonResponse;

class PartialGradesController extends Controller
{
    protected $listPartialGradesForEducatorService;
    protected $storePartialGradesService;

    public function __construct(ListPartialGradesForEducatorService $listPartialGradesForEducatorService,
                                StorePartialGradesService $storePartialGradesService
    )
    {
        $this->middleware('auth:api');
        $this->listPartialGradesForEducatorService = $listPartialGradesForEducatorService;
        $this->storePartialGradesService = $storePartialGradesService;
    }

    public function index(): JsonResponse
    {
        return $this->listPartialGradesForEducatorService->execute();
    }

    public function store(StorePartialGradeRequest $request): JsonResponse
    {
        return $this->storePartialGradesService->execute($request->validated());
    }
}

