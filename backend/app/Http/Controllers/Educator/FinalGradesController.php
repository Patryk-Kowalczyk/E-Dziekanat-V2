<?php

declare(strict_types=1);

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\MyApp\Grade\Request\updateFinalGradeRequest;
use App\MyApp\Grade\Services\ListFinalGradeForEducatorService;
use App\MyApp\Grade\Services\UpdateFinalGradeService;
use Illuminate\Http\JsonResponse;

class FinalGradesController extends Controller
{
    protected $listFinalGradeForEducatorService;
    protected $updateFinalGradeService;

    public function __construct(ListFinalGradeForEducatorService $listFinalGradeForEducatorService,
                                UpdateFinalGradeService $updateFinalGradeService
    )
    {
        $this->middleware('auth:api');
        $this->listFinalGradeForEducatorService = $listFinalGradeForEducatorService;
        $this->updateFinalGradeService = $updateFinalGradeService;
    }

    public function index(): JsonResponse
    {
        return $this->listFinalGradeForEducatorService->execute();
    }

    public function update(UpdateFinalGradeRequest $request): JsonResponse
    {
        return $this->updateFinalGradeService->execute($request->validated());
    }
}
