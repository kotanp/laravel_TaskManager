<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUgyvezeto
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //login-ra redirect-el ha felhasznalo a munkakore egyebkent tovabb enged
        if (Auth::user()->user->munkakor=='felhasznalo'){
            return redirect()->back();
            //return redirect('/login');
        }
        return $next($request);
    }
}
