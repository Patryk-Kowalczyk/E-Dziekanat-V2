<?php

namespace App\MyApp\Subject\Services;

use App\MyApp\Subject\Repositories\SubjectRepository;
use App\MyApp\User\Repositories\UserRepository;
use App\MyApp\Utility\Response;
use Illuminate\Http\JsonResponse;

class SubjectServices
{
    public $userRepository;
    public $subjectRepository;

    public function __construct(UserRepository $userRepository, SubjectRepository $subjectRepository)
    {
        $this->userRepository=$userRepository;
        $this->subjectRepository=$subjectRepository;
    }

    public function listSubjectChooseServices(): JsonResponse
    {
        return Response::build($result, 200);
    }


}
