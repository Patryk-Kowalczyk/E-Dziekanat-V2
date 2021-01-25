<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\dateFormatTrait;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public $student;

    public function __construct()
    {
        $this->middleware('auth:api');

    }

    public function index()
    {
        return response()->json(
            [
                'student_data' => $this->dataStudent(), //Pobranie danych studenta
                'day_plan' => $this->dayPlan(), //Pobranie planu z Current Day (Brak warunku)
                'last_grades' => $this->lastGrades(),  //Pobranie ostatnich ocen
                'avg_grades' => $this->avgGrades(),  //Pobranie średnich ocen
            ], 200);
    }

    private function dataStudent(): array
    {
        $this->student = Student::with(['User', 'Group'])->where('students.user_id', Auth::id())->first();
        $studentData['first_name'] = $this->student->user->first_name;
        $studentData['last_name'] = $this->student->user->last_name;
        $studentData['album'] = $this->student->album;
        $studentData['profile_picture'] = $this->student->user->profile_picture;
        $studentData['group'] = $this->student->group->name;
        return $studentData;
    }

    private function dayPlan(): array
    {
        $plans = Plan::with(['subjects', 'educator'])
            ->where('plans.group_id', $this->student->group->id)
            ->get();

        foreach ($plans as $plan) {
            $resultDayPlan['name'] = $plan->subjects[0]->name;
            $resultDayPlan['since'] = $plan->since;
            $resultDayPlan['to'] = $plan->to;
            $resultDayPlan['room'] = $plan->room;
            $resultDayPlan['form'] = $plan->subjects[0]->form;
            $resultDayPlan['educator'] = $plan->educator->getFullName();
            $dayPlan[] = $resultDayPlan;
        }
        return $dayPlan;
    }

    private function lastGrades(): array
    {
        $grades = Grade::with('subjects')
            ->where('grades.student_id', $this->student->user_id)
            ->latest('created_at')
            ->paginate(5);


        $lastGrades = [];
        foreach ($grades as $grade) {
            $resultLastGrades['name'] = $grade->subjects[0]->name;
            $resultLastGrades['form'] = $grade->subjects[0]->form;
            $resultLastGrades['value'] = $grade->value;
            $resultLastGrades['date'] = dateFormatTrait::format_Ymd_Hi($grade->created_at);
            $lastGrades[] = $resultLastGrades;
        }
        return $lastGrades;
    }

    private function avgGrades()
    {
        return Grade::where('student_id', Auth::id())
            ->join('subjects_grades', 'grades.id', '=', 'subjects_grades.grade_id')
            ->join('subjects', 'subjects_grades.subject_id', '=', 'subjects.id')
            ->groupBy('subjects.name')
            ->select('subjects.name', DB::raw('avg(grades.value) as avg'))
            ->get();

    }
}
