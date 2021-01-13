<?php


namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Grade;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Group;
use App\Models\Student;
use App\Models\Plan;
use App\Models\Subject;
use App\Models\Educator;
use Illuminate\Http\Request;
use Tymon\JWTAuth;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        //Pobranie danych studenta
        $user = auth()->user();
        $student = Student::with(['User', 'Group'])->where('students.user_id', $user->id)->get();
        $studentData['first_name'] = $student[0]->user->first_name;
        $studentData['last_name'] = $student[0]->user->last_name;
        $studentData['album'] = $student[0]->album;
        $studentData['profile_picture'] = $student[0]->user->profile_picture;
        $studentData['group'] = $student[0]->group->name;

        //Pobranie planu z Current Day (Nie ma jeszcze dodanego tego warunku - Current Day)
        $plans = Plan::with(['subjects', 'educator'])
            ->where('plans.group_id', $student[0]->group->id)
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
            ->where('grades.student_id', $student[0]->group_id)
            ->latest('created_at')
            ->get();

        $lastGrades = [];
        foreach ($grades as $grade) {
            $resultLastGrades['name'] = $grade->subjects[0]->name;
            $resultLastGrades['form'] = $grade->subjects[0]->form;
            $resultLastGrades['value'] = $grade->value;
            $resultLastGrades['date'] = $grade->created_at->format('Y-m-d H:i:s');
            $lastGrades[] = $resultLastGrades;
        }

        return response()->json(
            [
                'student' => $studentData,
                'dayPlan' => $dayPlan,
                'lastGrades' => $lastGrades
            ], 200);

    }
}
