<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth;

class DashboardController extends Controller
{

    public function __construct(Request $request)
    {

    }

    public function index(Request $request)
    {
        $dataUser=auth()->user();
            $scoreStats = User::select('*')
                ->where('id',$dataUser->id)
                ->get();
            return $scoreStats;
    }
}
