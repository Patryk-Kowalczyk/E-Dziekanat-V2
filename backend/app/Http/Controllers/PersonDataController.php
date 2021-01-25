<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PersonDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = User::with('Student')->find(Auth::id());

        $userData['id']=$data->id;
        $userData['name']=$data->getName();
        $userData['album']=$data->student->album;
        $userData['faculty']=$data->student->faculty;
        $userData['field_of_study']=$data->student->field_of_study;
        $userData['specialization']=$data->student->specialization;
        $userData['semester']=$data->student->semester;
        $userData['phone']=$data->phone;
        $userData['email']=$data->email;

        return response()->json(['user_data'=>$userData]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'int',
            'email' => 'email'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }
        $user = User::find(Auth::id());

        if($request['email']) $user->email=$request['email'];
        if($request['phone']) $user->phone=$request['phone'];
        $user->save();

        $response = [
            'success' => true,
        ];
        return response()->json($response, 200);
    }

}
