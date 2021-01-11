<?php


namespace App\Http\Controllers;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Plan;
use App\Models\Subject;
use App\Models\Educator;
use Illuminate\Http\Request;
use Tymon\JWTAuth;
use League\Fractal;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $plans = Plan::all();

        $resultsAll = [];
        foreach ($plans as $plan){
            $result['name']=$plan->subjects[0]->name;
            $result['since']=$plan->since;
            $result['to']=$plan->to;
            $result['room']=$plan->to;
            $result['form']=$plan->subjects[0]->form;

            $resultsAll[]=$result;
        }

//        foreach($plans as $plan)
//        {
//            $resource[] = $plans[]->subjects[0]->name;
//        }

        return response()->json(
            $resultsAll
        , 200);


        //        $user = auth()->user();
//        $idUser=$user->id;
//
//        $group = $dataUser['student']=User::join('students','students.user_id','=','users.id')
//            ->join('groups','groups.id','=','students.group_id')
//            ->select('groups.name as group_name')
//            ->where('users.id',$idUser)
//            ->first();
//
//        $dataUser['student']=User::join('students','students.user_id','=','users.id')
//                ->join('groups','groups.id','=','students.group_id')
//                ->select('users.first_name',
//                    'users.last_name',
//                    'students.album',
//                    'users.profile_picture',
//                    'groups.name as group_name')
//                ->where('users.id',$idUser)
//                ->get();
        //$dataUser['plans']=Plan::find(1);

        //dd($plans[0]->subject-?);
       //return $plans;
        //dd( $plans[0]->subjects);
        //return $plans;

      //  return $plan;
      //  return $dataUser['plans'];

//        foreach ($dataUser['plans']->subjects as $subject) {
//            echo $subject->name;
//        }





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
