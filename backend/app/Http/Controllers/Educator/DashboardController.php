<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\MyApp\User\Services\DashboardService;
use Illuminate\Http\JsonResponse;


class DashboardController extends Controller
{
    public $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth:api');
        $this->dashboardService=$dashboardService;
    }

    public function index(): JsonResponse
    {
        return $this->dashboardService->getEducatorDashboard();
    }


}
