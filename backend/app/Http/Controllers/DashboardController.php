<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Tymon\JWTAuth;

class DashboardController extends Controller
{

    public function __construct(Request $request)
    {
    }

    public function index(Request $request)
    {
        $dataUser = auth()->user();

        $user = User::select('users.name','users.lastname','users.profile_picture','students.student_number','groups.name as name_group')
            ->join('students','users.id','=','students.user_id')
            ->join('groups','groups.id','=','students.group_id')
            ->where('users.id', $dataUser->id)
            ->get();

        return $user;
    }
}
