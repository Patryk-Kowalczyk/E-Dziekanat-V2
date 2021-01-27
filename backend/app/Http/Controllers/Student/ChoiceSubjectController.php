<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SelectSubjectModels\Option;
use App\Models\SelectSubjectModels\Studentchoice;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChoiceSubjectController extends Controller
{
    public $student;
    public $studentChoices;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->student = Student::where('user_id', Auth::id())->first();
        $this->studentChoices = Studentchoice::where('student_id', $this->student->id)->get();
    }

    public function index()
    {

        $final = [];
        $resultOptions = [];
        foreach ($this->studentChoices as $studentChoice) {

            $result['id_question'] = $studentChoice->choice->id;
            $result['name_question'] = $studentChoice->choice->name;
            $result['chosen'] = $studentChoice->option_id;
            $options = Option::where("choice_id", $studentChoice->choice->id)->get();
            foreach ($options as $option) {

                $resultOneOption['option_id'] = $option->id;
                $resultOneOption['option'] = $option->name;
                $resultOptions[] = $resultOneOption;
            }
            $result['answers'] = $resultOptions;
            $resultOptions = [];
            $final[] = $result;
        }
        return response()->json(['subject_choose' => $final]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.choice_id' => 'required|int',
            '*.option_id' => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data=$request->all();
        foreach($data as $record) {
            $choice = $this->studentChoices->where('choice_id', $record['choice_id'])->first();
            $choice->option_id = $record['option_id'];
            $choice->save();
        }

        return 'success';


    }


}
