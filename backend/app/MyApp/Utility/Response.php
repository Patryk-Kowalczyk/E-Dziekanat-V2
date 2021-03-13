<?php

namespace App\MyApp\Utility;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\JsonResponse;

class Response
{
    static function build($data,int $status, $message=""):JsonResponse
    {
        return response()->json([
            'data' => $data ?? [],
            'message'=>static::getMessage($message),
            'status'=>$status
        ],$status);
    }

    static function getMessage($message):string
    {
        return trans($message);
    }

}


