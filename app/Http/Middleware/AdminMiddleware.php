<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role_id !== 3)
        {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
