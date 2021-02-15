<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\MyApp\Grade\Services\ListFinalGradeForStudentService;
use Illuminate\Http\JsonResponse;

class FinalGradeController extends Controller
{
    protected $listFinalGradeForStudentService;

    public function __construct(ListFinalGradeForStudentService $listFinalGradeForStudentService)
    {
        $this->middleware('auth:api');
        $this->listFinalGradeForStudentService = $listFinalGradeForStudentService;
    }

    public function index(): JsonResponse
    {
        return $this->listFinalGradeForStudentService->execute();
    }
}
