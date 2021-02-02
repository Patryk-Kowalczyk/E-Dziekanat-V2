<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;

class Response
{
    static function build($data,int $status, $message=""):JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message'=>$message,
            'status'=>$status
        ],$status);
    }
}
