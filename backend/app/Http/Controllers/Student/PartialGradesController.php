<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\MyApp\Grade\Services\PartialGradeService;
use Illuminate\Http\JsonResponse;


class PartialGradesController extends Controller
{
    protected $partialGradeService;

    public function __construct(PartialGradeService $partialGradeService)
    {
        $this->middleware('auth:api');
        $this->partialGradeService=$partialGradeService;
    }

    public function index(): JsonResponse
    {
        return $this->partialGradeService->getAllStudentPartialGrades();
    }

}
