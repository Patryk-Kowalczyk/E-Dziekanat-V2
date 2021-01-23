<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

}
