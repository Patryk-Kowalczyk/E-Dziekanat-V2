<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\dateFormatTrait;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Plan;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function weekIndex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dateStart' => 'required|date',
            'dateEnd' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::find(Auth::id());
        $from = $request['dateStart'];
        $to = $request['dateEnd'];
        if($user->status=="student")
            $plans = Plan::whereBetween('date', [$from, $to])->where('group_id', $user->student->group->id)->get();
        if($user->status=="educator")
            $plans = Plan::whereBetween('date', [$from, $to])->where('educator_id', $user->educator->id)->get();

        //To trzeba wrzucic do traits
        $days = [];
        $stepVal = '+1 day';
        $current = strtotime($from);
        $last = strtotime($to);
        while ($current <= $last) {
            $days[] = date('Y-m-d', $current);
            $current = strtotime($stepVal, $current);
        }

        $planWeek = [];
        $planDay = [];
        foreach ($days as $dayCurrent) {
            foreach ($plans as $plan) {
                if ($dayCurrent == $plan->date) {
                    $result['since'] = $plan->since;
                    $result['to'] = $plan->to;
                    $result['name'] = $plan->subjects[0]->name;
                    if($user->status=="student")
                        $result['teacher'] = $plan->educator->getFullName();
                    $result['room'] = $plan->room;
                    $result['form'] = $plan->subjects[0]->form;
                    $planDay[] = $result;
                }
            }
            $planWeek[$dayCurrent] = $planDay;
            $planDay = [];
        }

        return response()->json(['plan_week' => $planWeek]);


    }

    public function dayIndex(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dateOfDay' => 'required|date',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::find(Auth::id());
        $day = $request['dateOfDay'];

        if($user->status=="student")
            $plan = Plan::where('date', $day)->where('group_id', $user->student->group->id)->get();
        if($user->status=="educator")
            $plan = Plan::where('date', $day)->where('educator_id', $user->educator->id)->orderBy('since')->get();


        $planOfDay = [];
        foreach ($plan as $lesson) {
            $result['since']=$lesson->since;
            $result['to']=$lesson->to;
            if($user->status=="student")
                $result['teacher'] = $lesson->educator->getFullName();
            $result['name']=$lesson->subjects[0]->name;
            $result['room']=$lesson->room;
            $result['form']=$lesson->subjects[0]->form;
            $planOfDay[]=$result;
        }

        return response()->json(['plan_day' => $planOfDay]);

    }


}
