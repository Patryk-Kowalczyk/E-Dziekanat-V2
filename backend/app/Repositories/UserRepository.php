<?php


namespace App\Repositories;


use App\Models\Educator;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    protected $student;
    protected $educator;

    public function __construct(Student $student, Educator $educator)
    {
        $this->student=$student;
        $this->educator=$educator;
    }

    #============================ STUDENT ============================#

    public function getStudentData()
    {
        return $this->student->where('id',$this->getStudentId())->first();
    }

    public function getStudentId()
    {
        return $this->student->where('user_id',Auth::id())->first()->id;
    }

    public function getStudentGroupId()
    {
        return $this->student->where('user_id',Auth::id())->first()->group_id;
    }


    #============================ EDUCATOR ============================#

    public function getEducatorId()
    {
        return $this->educator->where('user_id',Auth::id())->first()->id;
    }

}
