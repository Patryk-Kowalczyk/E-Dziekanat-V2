<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\SubjectTransformer;
use App\Models\Student;
use App\Models\Subject;
use App\Models\FinalGrade;
use App\Models\Educator;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\Fractal;
use League\Fractal\TransformerAbstract;

class FinalGradeController extends Controller
{
    public $student;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->student = Student::where('students.user_id', Auth::id())->first();
    }


    public function index()
    {




        $subjectsWithFinalGrades = Subject::with(['finalgrades' => function ($q) {
            $q->where('final_grades.student_id', $this->student->id);
        }])->get();

        $FinalGrades = [];
        foreach ($subjectsWithFinalGrades as $record) {
            $result['name'] = $record['name'];
            $result['form'] = $record['form'];
            $result['educator'] = $record->educator->getFullName();
            $result['hours'] = $record['hours'];
            $result['first_term'] = $record->finalgrades[0]->first_term ?? NULL;
            $result['first_repeat'] = $record->finalgrades[0]->first_repeat ?? NULL;
            $result['second_repeat'] = $record->finalgrades[0]->second_repeat ?? NULL;
            $result['committee'] = $record->finalgrades[0]->committee ?? NULL;
            $result['promotion'] = $record->finalgrades[0]->promotion ?? NULL;
            $result['ECTS'] = $record['ECTS'];
            $FinalGrades[] = $result;
        }
        return response()->json(['final_grade' => $FinalGrades]);
    }

}



//        $finalGrade = Subject::with(['educator:title','grades' => function ($q) {
//            $q->where('grades.student_id', Auth::id());
//        }])->orderBy('name')->get()->makeHidden(['grades']);
//        $finalGrade=$finalGrade->makeVisible(['first_term','first_repeat','second_repeat','committee','promotion','ECTS']);
//        dd($finalGrade['Podstawy informacji'][0]->educator->user->first_name);
//
//        $finalGrade = Subject::with(['educator','grades' => function ($q) {
//            $q->where('grades.student_id', 1);
//        }])->orderBy('name')->get();
//
//        $final=[];
//        foreach($finalGrade as $grade)
//        {
//            $result['name']=$grade->name;
//            $result['form']=$grade->form;
//            if(isset($grade->educator->user->id))
//                $result['educator']=$grade->educator->title.' '. $grade->educator->user->first_name.' '.$grade->educator->user->last_name;
//            else
//                $result['educator']=NULL;
//            $result['hours']=$grade->hours;
//            $result['first_term']=$grade->first_term;
//            $result['first_repeat']=$grade->first_repeat;
//            $result['second_repeat']=$grade->second_repeat;
//            $result['committee']=$grade->committee;
//            $result['promotion']=$grade->promotion;
//            $result['ECTS']=$grade->ECTS;
//            $final[]=$result;
//        }
//
//        $finalGrade = Subject::with(['finalgrades' => function ($q) {
//            $q->outerJoin('subjects', 'final_grades.subject_id', '=', 'subjects.id');
//        }])->get();
