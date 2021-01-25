<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\Models\Educator;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\dateFormatTrait;

class PartialGradesController extends Controller
{
    public $educator;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->educator = Educator::with(['User'])->where('educators.user_id', Auth::id())->first();
    }

    public function index()
    {
        $subjects = Subject::with(['grades', 'educator'])->where('educator_id', $this->educator->id)->get();
        $students = Student::all();

        $resultData = [];
        $resultGrade = [];
        $resultGradeOne = [];
        foreach ($subjects as $subject) {
            $result['id_subject'] = $subject->id;
            $result['name'] = $subject->name;
            $result['form'] = $subject->form;
            foreach ($students as $student) {
                $resultStudent['first_name'] = $student->user->first_name;
                $resultStudent['last_name'] = $student->user->last_name;
                $resultStudent['album'] = $student->album;
                $resultStudent['group'] = $student->group->name;
                $resultStudent['group_id'] = $student->group->id;
                $grades = Grade::with(['subjects'])->where('student_id', $student->id)
                    ->get();
                foreach ($grades as $grade) {
                    if ($grade->subjects[0]->name == $subject->name && $grade->subjects[0]->form == $subject->form) {
                        $resultGrade['id'] = $grade->id;
                        $resultGrade['category'] = $grade->category;
                        $resultGrade['value'] = $grade->value;
                        $resultGrade['comments'] = $grade->comments;
                        $resultGrade['date'] = dateFormatTrait::format_Ymd($grade->created_at);
                        $resultGradeOne[] = $resultGrade;
                    }
                }
                $resultStudent['marks'] = $resultGradeOne;
                $resultGradeOne = [];
                $resultDataStudent[] = $resultStudent;
            }
            $result['squad'] = $resultDataStudent;
            $resultDataStudent = [];
            $resultData[] = $result;
        }
        return response()->json(['groups' => $resultData]);
    }

    public function store(Request $request)
    {
        $getGrades = $request->all();
        $subject_id = $getGrades[0]['subject_id'];
        $album = $getGrades[0]['album'];
        $studentId = Student::where('students.album', $album)->select('id')->first();


        $key = 1;

        //dd($getGrades[1]['id']);
        while ($key < count($getGrades)) {
            $nowGrades = Grade::with(['subjects'])
                ->where('student_id', $studentId->id)
                ->find($getGrades[$key]['id']);

            if($getGrades[$key]['id']=="new"){
                $grade = new Grade;
                $grade->category = $getGrades[$key]['category'];
                $grade->value = $getGrades[$key]['value'];
                $grade->comments = $getGrades[$key]['comments'];
                $grade->student_id = $studentId->id;
                $grade->save();
                $subject = Subject::find($subject_id);
                $grade->subjects()->attach($subject);
                $key++;
                continue;
            }
            if($nowGrades->value!=$getGrades[$key]['value'])
            {
                $nowGrades->value=$getGrades[$key]['value'];
                $nowGrades->save();
            }
            if($nowGrades->category!=$getGrades[$key]['category'])
            {
                $nowGrades->category=$getGrades[$key]['category'];
                $nowGrades->save();
            }
            if($nowGrades->comments!=$getGrades[$key]['comments'])
            {
                $nowGrades->comments=$getGrades[$key]['comments'];
                $nowGrades->save();
            }
            if($nowGrades->value!=$getGrades[$key]['value'])
            {
                $nowGrades->value=$getGrades[$key]['value'];
                $nowGrades->save();
            }
            $key++;
        }
        //return response()->json(['groups' => $test]);
    }


}

