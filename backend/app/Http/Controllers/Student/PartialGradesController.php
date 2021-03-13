<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\MyApp\Grade\Services\ListPartialGradesForStudentService;
use Illuminate\Http\JsonResponse;

class PartialGradesController extends Controller
{
    protected $listPartialGradesForStudentService;

    public function __construct(ListPartialGradesForStudentService $listPartialGradesForStudentService)
    {
        $this->middleware('auth:api');
        $this->listPartialGradesForStudentService = $listPartialGradesForStudentService;
    }

    public function index(): JsonResponse
    {
        return $this->listPartialGradesForStudentService->execute();
    }
}
