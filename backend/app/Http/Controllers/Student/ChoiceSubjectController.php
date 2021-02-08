<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\MyApp\Subject\Request\StoreChoiceSubjectRequest;
use App\MyApp\Subject\Services\SubjectChoiceServices;
use Illuminate\Http\JsonResponse;



class ChoiceSubjectController extends Controller
{
    public $student;
    public $subjectChoiceServices;

    public function __construct(SubjectChoiceServices $subjectChoiceServices)
    {
        $this->middleware('auth:api');
        $this->subjectChoiceServices=$subjectChoiceServices;
    }

    public function index(): JsonResponse
    {
        return $this->subjectChoiceServices->listOfSubjectToChooseForStudent();
    }

    public function store(StoreChoiceSubjectRequest $request): JsonResponse
    {
        return $this->subjectChoiceServices->storeSubjectChoiceStudent($request->validated());
    }




}
