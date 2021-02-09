<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\MyApp\Poll\Services\StatsServices;
use Illuminate\Http\JsonResponse;


class PollStatsController extends Controller
{
    protected $statsServices;

    public function __construct(StatsServices $statsServices)
    {
        $this->middleware('auth:api');
        $this->statsServices=$statsServices;
    }

    public function index(): JsonResponse
    {
        return $this->statsServices->getStatsPoll();
    }

}
