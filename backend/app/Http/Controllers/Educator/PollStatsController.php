<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\Models\PollModels\Pollquestion;
use App\Models\PollModels\Pollstudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PollStatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $dataPoll= Pollquestion::with(['pollstudents'])->where('poll_id',2)->get();
        $i=1;
        while($i<6) {
            $countPoll[$i]['name'] = $dataPoll[$i-1]->name;
            $countPoll[$i]['answers'] = Pollstudent::where('poll_id', 2)->where('question_id', $i)
                ->where('answer_id', '!=', 'null')
                ->select(DB::raw("count(answer_id) as count"), 'answer_id')
                ->groupBy('answer_id')
                ->get();
            $i++;
        }

        return response()->json(['stats' => $countPoll]);

    }

}
