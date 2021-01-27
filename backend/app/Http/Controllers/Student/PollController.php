<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PollModels\Pollname;
use App\Models\PollModels\Pollquestion;
use App\Models\PollModels\Pollstudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PollController extends Controller
{
    public $student;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->student = Student::where('students.user_id', Auth::id())->first();
    }

    public function list()
    {
        $polls = Pollstudent::with('pollname')
            ->where('student_id', $this->student->id)->select('poll_id','status')
            ->groupBy('poll_id','status')
            ->get();


        $final = [];
        foreach ($polls as $poll) {
            $result['poll_id'] = $poll->poll_id;
            $result['poll_name'] = $poll->pollname->name;
            $result['since'] = $poll->pollname->since;
            $result['to'] = $poll->pollname->to;
            $result['status'] = $poll->status;
            $final[] = $result;
        }
        return response()->json(['list_polls' => $final]);
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poll_id' => 'required|int',
        ]);

        $qa=Pollquestion::with('pollanswers')
            ->where('poll_id', $request->all('poll_id'))
            ->get();

        $status=Pollstudent::where('poll_id',$request->all('poll_id'))
            ->where('student_id',$this->student->id)
            ->select('status')
            ->first();

        return response()->json([
            'status' => $status,
            'question_and_answers' => $qa
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.poll_id' => 'required|int',
            '*.question_id' => 'required|int',
            '*.answers_id' => 'required|int',
        ]);
        $data=$request->all();

        foreach($data as $record)
        {
            $pollsstudent = Pollstudent::where('student_id', $this->student->id)
                ->where('poll_id',2,$record['poll_id'])
                ->where('question_id',$record['question_id'])
                ->first();
            $pollsstudent->answer_id=$record['answer_id'];
            $pollsstudent->status=1;
            $pollsstudent->save();
        }

        return $data;
    }


}
