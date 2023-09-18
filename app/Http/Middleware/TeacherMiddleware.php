<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(\Illuminate\Support\Facades\Auth::check())){

            if(\Illuminate\Support\Facades\Auth::user()->role == 3){

                return $next($request);
            }
            else{
                \Illuminate\Support\Facades\Auth::logout();
                return redirect(url('/'));
            }
        }
        else{
            \Illuminate\Support\Facades\Auth::logout();
            return redirect(url('/'));
        }
    }
}
