<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\PollModels\Pollname;
use App\Models\PollModels\Pollquestion;
use App\Models\PollModels\Pollstudent;
use App\Models\Student;
use App\MyApp\Poll\Requests\ShowPollByIdRequest;
use App\MyApp\Poll\Requests\StoreAnswersRequest;
use App\MyApp\Poll\Services\PollServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PollController extends Controller
{
    public $pollServices;


    public function __construct(PollServices $pollServices)
    {
        $this->middleware('auth:api');
        $this->pollServices = $pollServices;
    }

    public function list(): JsonResponse
    {
        return $this->pollServices->getListStudentPolls();
    }

    public function show(ShowPollByIdRequest $request): JsonResponse
    {
        return $this->pollServices->showPoll($request->validated());
    }

    public function store(StoreAnswersRequest $request): JsonResponse
    {
        return $this->pollServices->storeAnswersPoll($request->validated());
    }


}
