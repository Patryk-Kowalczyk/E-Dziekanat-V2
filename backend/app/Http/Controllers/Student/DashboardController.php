<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\MyApp\User\Services\DashboardService;
use Illuminate\Http\JsonResponse;


class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth:api');
        $this->dashboardService=$dashboardService;
    }

    public function index(): JsonResponse
    {
        return Response::build($this->dashboardService->getStudentDashboard(),200);
    }
}
