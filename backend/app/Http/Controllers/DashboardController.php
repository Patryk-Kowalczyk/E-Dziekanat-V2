<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\MyApp\User\Services\ShowUserDashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    protected $showUserDashboard;

    public function __construct(ShowUserDashboardService $showUserDashboard)
    {
        $this->middleware('auth:api');
        $this->showUserDashboard = $showUserDashboard;
    }

    public function index(): JsonResponse
    {
        return $this->showUserDashboard->execute();
    }
}
