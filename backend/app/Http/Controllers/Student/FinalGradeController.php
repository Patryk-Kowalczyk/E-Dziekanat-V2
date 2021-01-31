<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\FinalGradeService;


class FinalGradeController extends Controller
{
    protected $finalGradeService;

    public function __construct(FinalGradeService $finalGradeService)
    {
        $this->middleware('auth:api');
        $this->finalGradeService=$finalGradeService;
    }

    public function index()
    {
        return response()->json(['final_grade'=>$this->finalGradeService->getAllStudentFinalGrades()]);
    }

}
