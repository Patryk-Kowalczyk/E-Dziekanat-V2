<?php

namespace App\Http\Controllers;

use App\Http\Traits\dateFormatTrait;
use App\Models\Grade;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\Student;
use App\Models\Plan;
use App\Models\Subject;
use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth;
use Exception;


class DashboardController extends Controller
{


    public function index(Request $request)
    {

        try {


            //Pobranie danych studenta
            $student = Student::with(['User', 'Group'])->where('students.user_id', Auth::id())->first();

            $studentData['first_name'] = $student->user->first_name;
            $studentData['last_name'] = $student->user->last_name;
            $studentData['album'] = $student->album;
            $studentData['profile_picture'] = $student->user->profile_picture;
            $studentData['group'] = $student->group->name;

            //Pobranie planu z Current Day (Nie ma jeszcze dodanego tego warunku - Current Day)
            $plans = Plan::with(['subjects', 'educator'])
                ->where('plans.group_id', $student->group->id)
                ->get();

            foreach ($plans as $plan) {
                $resultDayPlan['name'] = $plan->subjects[0]->name;
                $resultDayPlan['since'] = $plan->since;
                $resultDayPlan['to'] = $plan->to;
                $resultDayPlan['room'] = $plan->room;
                $resultDayPlan['form'] = $plan->subjects[0]->form;
                $fullName = $plan->educator->title . ' ' . $plan->educator->user->first_name . ' ' . $plan->educator->user->last_name;
                $resultDayPlan['educator'] = $fullName;
                $dayPlan[] = $resultDayPlan;
            }

            //Pobieranie ostatnich ocen
            $grades = Grade::with('subjects')
                ->where('grades.student_id', $student->group_id)
                ->latest('created_at')
                ->get();

            $lastGrades = [];
            foreach ($grades as $grade) {
                $resultLastGrades['name'] = $grade->subjects[0]->name;
                $resultLastGrades['form'] = $grade->subjects[0]->form;
                $resultLastGrades['value'] = $grade->value;
                $resultLastGrades['date'] = dateFormatTrait::format_Ymd_His($grade->created_at);
                $lastGrades[] = $resultLastGrades;
            }

            $avgGrades=Grade::where('student_id',Auth::id())
                ->join('subjects_grades','grades.id','=','subjects_grades.grade_id')
                ->join('subjects','subjects_grades.subject_id','=','subjects.id')
                ->groupBy('subjects.name')
                ->select('subjects.name',DB::raw('avg(grades.value) as avg'))
                ->get();


            return response()->json(
                [
                    'student_data' => $studentData,
                    'day_plan' => $dayPlan,
                    'last_grades' => $lastGrades,
                    'avg_grades' => $avgGrades,
                ], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 'Token is Expired. Go to refresh'], 404);
        }

    }
}
