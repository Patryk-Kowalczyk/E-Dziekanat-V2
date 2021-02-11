<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\MyApp\Grade\Request\updateFinalGradeRequest;
use App\MyApp\Grade\Services\FinalGradeService;
use Illuminate\Http\JsonResponse;


class FinalGradesController extends Controller
{
    protected $finalGradeService;

    public function __construct(FinalGradeService $finalGradeService)
    {
        $this->middleware('auth:api');
        $this->finalGradeService=$finalGradeService;
    }

    public function index(): JsonResponse
    {
        return $this->finalGradeService->getFinalGradesForEducatorPanel();
    }

    public function update(UpdateFinalGradeRequest $request): JsonResponse
    {
        return $this->finalGradeService->updateFinalGrades($request->validated());
    }
}
