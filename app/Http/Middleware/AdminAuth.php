<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // if ($request->session()->get('is_admin') !== true) {
        //     return redirect('/login');
        // }

        // return $next($request);
        if (! Auth::check() || $request->session()->get('is_admin') !== true) {
            return redirect('/login');
        }

        return $next($request);
    }
}
