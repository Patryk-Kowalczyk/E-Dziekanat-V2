<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\MyApp\Grade\Services\FinalGradeService;
use App\Http\Response;
use Illuminate\Http\JsonResponse;


class FinalGradeController extends Controller
{
    protected $finalGradeService;

    public function __construct(FinalGradeService $finalGradeService)
    {
        $this->middleware('auth:api');
        $this->finalGradeService=$finalGradeService;
    }

    public function index(): JsonResponse
    {
        return Response::build($this->finalGradeService->getAllStudentFinalGrades(),200);
    }

}
