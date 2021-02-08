<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SelectSubjectModels\Option;
use App\Models\SelectSubjectModels\Studentchoice;
use App\Models\Student;
use App\MyApp\Subject\Services\SubjectServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChoiceSubjectController extends Controller
{
    public $student;
    public $subjectServices;

    public function __construct(SubjectServices $subjectServices)
    {
        $this->middleware('auth:api');
        $this->subjectServices=$subjectServices;
        $this->student = Student::where('user_id', Auth::id())->first();
       // $this->studentChoices = Studentchoice::where('student_id', $this->student->id)->get();
    }

    public function index()
    {
        return $this->subjectServices->listSubjectChooseServices();
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
