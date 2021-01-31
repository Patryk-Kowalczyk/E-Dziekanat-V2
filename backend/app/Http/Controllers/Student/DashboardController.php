<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\dateFormatTrait;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Plan;
use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
