<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;


class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth:api');
        $this->dashboardService=$dashboardService;
    }

    public function index()
    {

        return response()->json($this->dashboardService->getStudentDashboard(), 200);
    }
}
