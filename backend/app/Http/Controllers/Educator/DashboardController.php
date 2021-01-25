<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\Models\Educator;
use App\Models\Meeting;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $educator;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->educator = Educator::with(['User'])->where('educators.user_id', Auth::id())->first();
    }

    public function index()
    {
        return response()->json(
            [
                'teacher_data' => $this->dataEducator(), //Pobranie danych nauczyciela
                'day_plan' => $this->dayPlan(), //Pobranie planu z Current Day (Brak warunku)
                'meetings' => $this->meetings(),  //Pobranie ostatnich ocen
//                'avg_grades' => $this->avgGrades(),  //Pobranie średnich ocen
            ], 200);
    }

    private function dataEducator(): array
    {
        $educatorData['first_name'] = $this->educator->user->first_name;
        $educatorData['last_name'] = $this->educator->user->last_name;
        $educatorData['degree'] = $this->educator->title;
        $educatorData['profile_picture'] = $this->educator->user->profile_picture;
        return $educatorData;
    }

    private function dayPlan(): array
    {
        $plans = Plan::with(['subjects', 'group'])
            ->where('plans.educator_id', $this->educator->id)
            ->get();

        foreach ($plans as $plan) {
            $resultDayPlan['name'] = $plan->subjects[0]->name;
            $resultDayPlan['since'] = $plan->since;
            $resultDayPlan['to'] = $plan->to;
            $resultDayPlan['group'] = $plan->group->name;
            $resultDayPlan['room'] = $plan->room;
            $resultDayPlan['form'] = $plan->subjects[0]->form;
            $dayPlan[] = $resultDayPlan;
        }
        return $dayPlan;
    }

    private function meetings()
    {
        return  Meeting::where('meetings.educator_id', $this->educator->id)
            ->get()->makeHidden('id','educator_id');

    }

}
