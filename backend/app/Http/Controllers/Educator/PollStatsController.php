<?php

declare(strict_types=1);

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\MyApp\Poll\Services\StatsForEducatorService;
use Illuminate\Http\JsonResponse;

class PollStatsController extends Controller
{
    protected $statsForEducatorService;

    public function __construct(StatsForEducatorService $statsForEducatorService)
    {
        $this->middleware('auth:api');
        $this->statsForEducatorService=$statsForEducatorService;
    }

    public function index(): JsonResponse
    {
        return $this->statsForEducatorService->execute();
    }

}
