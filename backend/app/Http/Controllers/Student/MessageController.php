<?php

namespace App\Http\Controllers\Student;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $messages=Message::all();

        $allMessage=[];
        foreach($messages as $message)
        {
            $result['id']=$message->id;
            $result['title']=$message->title;
            $result['date']=$message->date;
            $textCut=strpos($message->text, ' ', 200);
            $result['text']=substr($message->text,0,$textCut ).'..'; ;
            $allMessage[]=$result;
        }

        return response()->json(['message' => $allMessage]);
    }

    public function show(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $message=Message::find($request['id']);

        $result['id']=$message->id;
        $result['title']=$message->title;
        $result['date']=$message->date;
        $result['text']=$message->text;
        $result['added_by']=$message->educator->getFullName();

        return response()->json(['message' => $result]);
    }

}
