<?php

namespace App\Http\Controllers\Educator;

use App\Http\Controllers\Controller;
use App\Models\Educator;
use App\Models\FinalGrade;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\dateFormatTrait;


class  FinalGradesController extends Controller
{
    public $educator;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->educator = Educator::with(['User'])->where('educators.user_id', Auth::id())->first();
    }

    public function index()
    {
        $subjects = Subject::with(['educator', 'finalgrades'])->where('educator_id', $this->educator->id)->get();
        $finalGrades = [];
        foreach ($subjects as $subject) {
            $result['id_subject'] = $subject->id;
            $result['name'] = $subject->name;
            $result['form'] = $subject->form;
            $tempStudent = [];
            foreach ($subject->finalgrades as $final) {
                $resultStudent['id_finalgrade'] = $final->id;
                $resultStudent['first_name'] = $final->student->user->first_name;
                $resultStudent['last_name'] = $final->student->user->last_name;
                $resultStudent['album'] = $final->student->album;
                $resultStudent['group'] = $final->student->group->name;
                $resultStudent['group_id'] = $final->student->group->id;
                $resultStudent['first_term'] = $final->first_term;
                $resultStudent['first_repeat'] = $final->first_repeat;
                $resultStudent['second_repeat'] = $final->second_repeat;
                $resultStudent['committee'] = $final->committee;
                $resultStudent['promotion'] = $final->promotion;
                $tempStudent[] = $resultStudent;
            }
            $result['squad'] = $tempStudent;
            $finalGrades[] = $result;
            $result = [];
        }

        return response()->json(['finalGrades' => $finalGrades]);
    }


    public function store(Request $request)
    {
        $getFinalGrade = $request->all();
        $id_finalgrade = $getFinalGrade['id_finalgrade'];


        $finalGrade = FinalGrade::findorfail($id_finalgrade);
        $finalGrade->first_term = $getFinalGrade['first_term'];
        $finalGrade->first_repeat = $getFinalGrade['first_repeat'];
        $finalGrade->second_repeat = $getFinalGrade['second_repeat'];
        $finalGrade->committee = $getFinalGrade['committee'];
        $finalGrade->promotion =  $getFinalGrade['promotion'];
        $finalGrade->save();
        return response()->json(['success' => 'pomyslnie dodano ocene'],200);
    }
}
