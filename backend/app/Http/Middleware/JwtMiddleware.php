<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;


class JwtMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid'],404);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                $newToken = JWTAuth::parseToken()->refresh();
                return response()->json(['status' => 'Token is Expired','token'=>$newToken],200);
            }else{
                return response()->json(['status' => 'Authorization Token not found'],404);
            }
        }
    }


}
