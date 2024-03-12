<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthenticationMiddleware
{
   public function handle(Request $request, Closure $next): Response
   {
      $token = $request->header("Authorization");

      $authenticate = true;

      if (!$token) {
         $authenticate = false;
      }

      if ($authenticate) {
         return $next($request);
      } else {
         return response()->json([
            "errors" => [
               "message" => "unauthorized"
            ]
         ])->setStatusCode(401);
      }
   }
}
