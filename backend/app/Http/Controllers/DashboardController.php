<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Plan;
use App\Models\Educator;
use Illuminate\Http\Request;
use Tymon\JWTAuth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $idUser = auth()->user();
        $dataUser['person']=User::join('students','students.user_id','=','users.id')
                ->join('groups','groups.id','=','students.group_id')
                ->select('users.first_name','users.last_name','students.album','users.profile_picture','groups.name as group_name')
                ->where('users.id',$idUser->id)
                ->get();

        $dataUser['plan']=Plan::all();

        return $dataUser;

//        $user = User::select('users.name','users.lastname','users.profile_picture','students.student_number','groups.name as name_group')
//            ->join('students','users.id','=','students.user_id')
//            ->join('groups','groups.id','=','students.group_id')
//            ->where('users.id', $dataUser->id)
//            ->get();
//
//
//
//        $plantoday=User::select('users.name','schedules.since')
//            ->join('students','users.id','=','students.user_id')
//            ->join('groups','groups.id','=','students.group_id')
//            ->join('schedules','schedules.id','=','groups.id')
//            ->join('subjects','subjects.id','=','schedules.subject_id')
//            ->where('users.id', $dataUser->id)
//            ->get();



    }
}
