<?php


namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\dateFormatTrait;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Plan;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PartialGradesController extends Controller
{
    public $student;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->student = Student::where('students.user_id', Auth::id())->first();
    }

    public function index()
    {
        $partialGrades = Subject::with(['grades' => function ($q) {
            $q->select(
                ['grades.category', 'grades.value', 'grades.comments', 'grades.created_at as date']
            )->where('grades.student_id', $this->student->id);
        }])->where('subjects.form', '!=', 'OK')->get();


        return response()->json(['partial_grades' => $partialGrades]);  //Pobranie ocen cząstkowych studenta
    }

}
