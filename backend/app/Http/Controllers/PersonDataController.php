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
        $this->middleware('auth:api',['except' => 'info']);
    }

    public function info()
    {
        try {
            $user = User::findorfail(Auth::id());
            return response()->json([
                'name' => $user->first_name,
                'status' => $user->status,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'status' => 'Not authorized',
            ], 401);
        }
    }

    public function index()
    {
        $data = User::with(['Student', 'Educator'])->find(Auth::id());
        if ($data->status == "student") {
            $userData['id'] = $data->id;
            $userData['name'] = $data->getName();
            $userData['album'] = $data->student->album;
            $userData['date_of_birth'] = $data->date_of_birth;
            $userData['faculty'] = $data->student->faculty;
            $userData['field_of_study'] = $data->student->field_of_study;
            $userData['specialization'] = $data->student->specialization;
            $userData['semester'] = $data->student->semester;
            $userData['phone'] = $data->phone;
            $userData['email'] = $data->email;
        }
        if ($data->status == "educator") {
            $userData['id'] = $data->id;
            $userData['name'] = $data->educator->getFullName();
            $userData['album'] = $data->educator->album;
            $userData['date_of_birth'] = $data->date_of_birth;
            $userData['phone'] = $data->phone;
            $userData['email'] = $data->email;
            $userData['address'] = $data->address;
        }

        return response()->json(['user_data' => $userData]);
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

        if ($request['email']) $user->email = $request['email'];
        if ($request['phone']) $user->phone = $request['phone'];
        $user->save();

        $response = [
            'success' => true,
        ];
        return response()->json($response, 200);
    }

}
