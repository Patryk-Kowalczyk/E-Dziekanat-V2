<?php


namespace App\Services;

use App\Models\Student;
use App\Models\User;
use App\Repositories\FinalGradeRepository;
use App\Repositories\UserRepository;
use App\Transforms\FinalGradeStudentTransformer;
use App\Transforms\TranformsUtil;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class FinalGradeService
{
    protected $userRepository;
    protected $finalGradeRepository;
    protected $fractal;
    protected $tranformsUtil;

    public function __construct(UserRepository $userRepository, FinalGradeRepository $finalGradeRepository, Manager $fractal, TranformsUtil $tranformsUtil)
    {
        $this->userRepository=$userRepository;
        $this->finalGradeRepository=$finalGradeRepository;
        $this->fractal=$fractal;
        $this->tranformsUtil=$tranformsUtil;
    }

    public function getAllStudentFinalGrades()
    {
        $id=$this->userRepository->getStudentId();
        $finalGrades = new Collection($this->finalGradeRepository->getByStudentId($id),$this->tranformsUtil->getTransformer(3));
        return $this->fractal->createData($finalGrades);
    }



}
