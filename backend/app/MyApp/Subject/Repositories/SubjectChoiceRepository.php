<?php

declare(strict_types=1);

namespace App\MyApp\Subject\Repositories;


use App\Models\SelectSubjectModels\Choice;
use App\Models\SelectSubjectModels\Option;
use App\Models\SelectSubjectModels\Studentchoice;

class SubjectChoiceRepository
{
    protected $choice;
    protected $option;
    protected $studentChoice;

    public function __construct(Choice $choice, Option $option, Studentchoice $studentChoice)
    {
        $this->choice = $choice;
        $this->option = $option;
        $this->studentChoice = $studentChoice;
    }

    public function getAllStudentChoiceList($id)
    {
        return $this->studentChoice->with('choice:name,id')
            ->where('student_id',$id)
            ->select('choice_id','option_id')
            ->get();
    }

    public function getChoiceOptionsSubject($id)
    {
        return $this->option->where('choice_id',$id)->get();
    }

    public function updateChoiceSubjectByStudent($data,$id)
    {
        return $this->studentChoice
            ->where('student_id',$id)
            ->where('choice_id',$data['choice_id'])
            ->update([
                'option_id'=>$data['option_id'],
            ]);

    }


}
