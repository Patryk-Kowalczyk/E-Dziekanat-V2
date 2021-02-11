<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\MyApp\Grade\Request\StorePartialGradeRequest;
use App\MyApp\Grade\Services\PartialGradeService;
use Illuminate\Http\JsonResponse;

class PartialGradesController extends Controller
{
    public $partialGradeService;

    public function __construct(PartialGradeService $partialGradeService)
    {
        $this->middleware('auth:api');
        $this->partialGradeService=$partialGradeService;
    }

    public function index():JsonResponse
    {
        return $this->partialGradeService->getPartialGradesForEducatorPanel();
    }

    public function store(StorePartialGradeRequest $request): JsonResponse
    {
        return $this->partialGradeService->storePartialGrades($request->validated());
    }


}

