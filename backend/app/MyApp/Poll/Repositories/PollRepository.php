<?php

namespace App\MyApp\Poll\Repositories;

use App\Models\PollModels\Pollanswer;
use App\Models\PollModels\Pollname;
use App\Models\PollModels\Pollquestion;
use App\Models\PollModels\Pollstudent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PollRepository
{
    protected $pollstudent;
    protected $pollname;
    protected $pollquestion;
    protected $pollanswer;

    public function __construct(Pollstudent $pollstudent, Pollanswer $pollanswer, Pollquestion $pollquestion, Pollname $pollname)
    {
        $this->pollstudent = $pollstudent;
        $this->pollname = $pollname;
        $this->pollquestion = $pollquestion;
        $this->pollanswer = $pollanswer;
    }

    public function getPollStudent(): Collection
    {
        return $this->pollstudent->get();
    }

    public function getListForStudent($idPoll): Collection
    {
        return $this->pollstudent
            ->where('student_id', $idPoll)->select('poll_id', 'status')
            ->groupBy('poll_id', 'status')
            ->get();
    }

    public function getStatusActivityPollForStudent($idPoll, $idStudent): Model
    {
        return $this->pollstudent
            ->where('poll_id', $idPoll)
            ->where('student_id', $idStudent)
            ->select('status')
            ->first();
    }

    public function getPollDetails($idPoll): Collection
    {
        return $this->pollquestion->with('pollanswers')
            ->where('pollquestions.poll_id', $idPoll)
            ->get();
    }

    public function updateAnswers($data, $idStudent): bool
    {
        return $this->pollstudent
            ->where('student_id', $idStudent)
            ->where('question_id', $data['question_id'])
            ->where('poll_id', $data['poll_id'])
            ->update([
                'answer_id' => $data['answer_id'],
                'status' => 1
            ]);
    }

    public function getPollQuestions($id): Collection
    {
        return $this->pollquestion->where('poll_id', $id)->get();
    }

    public function getCountAnswers($id): Collection
    {
        return $this->pollstudent
            ->where('poll_id', 2)
            ->where('question_id', $id)
            ->where('answer_id', '!=', 'null')
            ->select(DB::raw("count(answer_id) as count"), 'answer_id')
            ->groupBy('answer_id')
            ->get();
    }
}
