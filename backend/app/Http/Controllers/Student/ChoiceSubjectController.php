<?php

declare(strict_types=1);

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\MyApp\Subject\Request\StoreChoiceSubjectRequest;
use App\MyApp\Subject\Services\ListSubjectChoice;
use App\MyApp\Subject\Services\StoreSubjectChoice;
use Illuminate\Http\JsonResponse;

class ChoiceSubjectController extends Controller
{
    public $listSubjectChoice;
    public $storeSubjectChoice;

    public function __construct(ListSubjectChoice $listSubjectChoice,
                                StoreSubjectChoice $storeSubjectChoice)
    {
        $this->middleware('auth:api');
        $this->listSubjectChoice = $listSubjectChoice;
        $this->storeSubjectChoice = $storeSubjectChoice;
    }

    public function index(): JsonResponse
    {
        return $this->listSubjectChoice->execute();
    }

    public function store(StoreChoiceSubjectRequest $request): JsonResponse
    {
        return $this->storeSubjectChoice->execute($request->validated());
    }
}
